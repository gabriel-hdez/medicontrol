<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CedulaVE Library.
 */

/*

EJEMPLO DE USO

$this->load->library('CedulaVE');
$data = $this->cedulave->get('V', '25880768');

*/
class CedulaVE
{
    const URL = 'http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=%s&cedula=%s';

    /**
     * The version.
     * @var string The current version.
     */
    private $version = '1.1.2';

    /**
     * The Author.
     * @var string The current author.
     */
    private $author = 'bracodev';

    /**
     * The Website.
     * @var string The current author.
     */
    private $api = 'https://api.megacreativo.com/public/cedula-ve/v1';

    /**
     * CodeIgniter instance.
     * @var CI_Controller
     */
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Gets the person's data.
     *
     * @param string  $nac      Type of Nationality [V|E]. Any other value will produce an Error 301
     * @param string  $cedula   Identity Card number to consult
     * @return array|mixed|string
     */
    public function get(string $nac, string $cedula)
    {
        return $this->info($nac, $cedula, false, false);
    }

    /**
     * Gets the person data and returns it as JSON.
     *
     * @param string  $nac      Type of Nationality [V|E]. Any other value will produce an Error 301
     * @param string  $cedula   Identity Card number to consult
     * @param bool    $pretty   (Optional) A JSON is returned, this parameter sets whether JSON_PRETTY_PRINT is applied. Default value FALSE
     * @return array|mixed|string
     */
    public function json(string $nac, string $cedula, bool $pretty = false)
    {
        return $this->info($nac, $cedula, true, $pretty);
    }

    /**
     * Gets the person's data.
     *
     * @param string  $nac      Type of Nationality [V|E]. Any other value will produce an Error 301
     * @param string  $cedula   Identity Card number to consult
     * @param bool    $json     (Optional) Return JSON as the response if true, otherwise return an ARRAY. Default value TRUE
     * @param bool    $pretty   (Optional) A JSON is returned, this parameter sets whether JSON_PRETTY_PRINT is applied. Default value FALSE
     * @return array|mixed|string
     */
    public function info(string $nac, string $cedula, bool $json = true, bool $pretty = false)
    {
        // begin validations

        if ($nac !== 'V' and $nac !== 'E') {
            return $this->errors(1, $json, $pretty);
        }

        if (empty($cedula)) {
            return $this->errors(2, $json, $pretty);
        }

        if (!is_numeric($cedula)) {
            return $this->errors(3, $json, $pretty);
        }

        // end validations

        $content = $this->queryCNE($nac, $cedula);

        if ($content['error'] === true) {
            return $this->errors($content['code'], $json, $pretty);
        }

        if ($this->existData($content['message'])) {
            // Data found
            $content = $this->processAndCleanData($content['message']);

            $fullname = $this->formatterName($content[2]);

            $response = [
                'status' => 200,
                'version' => $this->version,
                'api' => $this->api,
                'data' => [
                    'nac' => $nac,
                    'dni' => $cedula,
                    'name' => $fullname['name'],
                    'lastname' => $fullname['lastname'],
                    'fullname' => $content[2],
                    'state' => $content[3],
                    'municipality' => $content[4],
                    'parish' => $content[5],
                    'voting' => $content[6],
                    'address' => $content[7],
                ],
            ];

        } else {
            // Data not found
            return $this->errors(4, $json, $pretty);
        }

        return $this->response($response, $json, $pretty);
    }

    /**
     * Gets the person's data and returns it as an array.
     *
     * @param string  $nac      Type of Nationality [V|E]. Any other value will produce an Error 301
     * @param string  $cedula   Identity Card number to consult
     * @return array|mixed|string
     */
    public function toArray(string $nac, string $cedula)
    {
        return $this->info($nac, $cedula, false, false);
    }

    /**
     * Process and clean the data.
     *
     * @param string $content
     * @return array
     */
    private function processAndCleanData(string $content): array
    {
        $patterns = ['Cédula:', 'Nombre:', 'Estado:', 'Municipio:', 'Parroquia:', 'Centro:', 'Dirección:', 'SERVICIO ELECTORAL', 'Registro ElectoralCorte'];
        $patterns = str_ireplace($patterns, '|', $this->clean($content));
        $patterns = trim($patterns);

        $response = array_map([$this, 'clean'], explode('|', $patterns));

        return $response;
    }

    /**
     * Check if the person's data exists.
     *
     * @param string $content
     * @return bool
     */
    private function existData(string $content): bool
    {
        $pattern_1 = 'REGISTRO ELECTORAL';
        $position_1 = stripos($content, $pattern_1);

        $pattern_2 = 'ADVERTENCIA';
        $position_2 = stripos($content, $pattern_2);

        if ($position_1 !== false && $position_2 === false) {
            return true;
        }

        return false;
    }

    /**
     * Format the person's name according to the number of words in it.
     *
     * @param string $text
     * @return array
     */
    private function formatterName($text): array
    {
        $text = $this->clean($text);
        $text = explode(' ', $text);
        switch (count($text)) {
            case 2:
                $name = $text[0];
                $lastname = $text[1];
                break;
            case 3:
                $name = $text[0] . ' ' . $text[1];
                $lastname = $text[2];
                break;
            case 4:
                $name = $text[0] . ' ' . $text[1];
                $lastname = $text[2] . ' ' . $text[3];
                break;
            default:
                $count = count($text);
                $mitad = round($count / 2);
                $name = $lastname = '';
                for ($i = 0; $i < $mitad; $i++) {
                    $name .= $text[$i] . ' ';
                }
                for ($i = $mitad; $i < $count; $i++) {
                    $lastname .= $text[$i] . ' ';
                }
                break;
        }

        return [
            'name' => trim($name),
            'lastname' => trim($lastname),
        ];
    }

    /**
     * Remove line breaks and tabs.
     *
     * @param string $value
     * @return string
     */
    private function clean($value): string
    {
        $patterns = ["\n", "\t"];
        $r = trim(str_ireplace($patterns, ' ', $value));

        return str_ireplace("\r", '', str_replace("\n", '', str_replace("\t", '', $r)));
    }

    /**
     * Treatment of the response in JSON format.
     *
     * @param array $content
     * @param array $json
     * @param bool  $pretty
     * @return string
     */
    private function response(array $content, bool $json = true, bool $pretty = false)
    {
        if ($json === true) {
            header('Content-Type: application/json; charset=utf8');

            if ($pretty === true) {
                return json_encode($content, JSON_PRETTY_PRINT);
            }

            return json_encode($content);
        } else {
            return $content;
        }
    }

    /**
     * Error handling.
     *
     * @param array $content
     * @param array $json
     * @param bool  $pretty
     * @return string
     */
    private function errors(int $code, bool $json = true, bool $pretty = false)
    {
        switch ($code) {
            case 1:
                $code = '301';
                $message = 'Los datos recibidos no son correctos, Error en la nacionalidad. Valores permitidos [V|E]';
                break;
            case 2:
                $code = '302';
                $message = 'Los datos recibidos no son correctos. Se introdujo un caracter no numerico';
                break;
            case 3:
                $code = '303';
                $message = 'Debe ingresar una cedula de identidad válida. Sólo se permiten caracteres numéricos';
                break;
            case 4:
                $code = '404';
                $message = 'No se encontró la cédula de identidad';
                break;
            case 6:
                $code = '306';
                $message = 'El Host del CNE esta fuera de linea';
                break;
            default:
                $code = '500';
                $message = 'No se ha podido procesar la solicitud';
                break;
        }

        $response = [
            'status' => $code,
            'version' => $this->version,
            'api' => $this->api,
            'data' => $message,
        ];

        return $this->response($response, $json, $pretty);
    }

    private static function queryCNE(string $nac, string $dni): array
    {
        $url = sprintf(self::URL, $nac, $dni);
        $ch = curl_init(); // Use native PHP cURL functions
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $result = [
                'error' => true,
                'code' => curl_errno($ch),
                'message' => curl_error($ch),
            ];
        } else {
            $result = [
                'error' => false,
                'message' => strip_tags($response),
            ];
        }

        curl_close($ch);

        return $result;
    }
}