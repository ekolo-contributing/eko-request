<?php 
	namespace Ekolo\Components\EkoRequest;

	/**
	 * Gère comment envoyer les différentes requêtes http vers l'API
	 */
	class RequestStreamContent
	{
        /**
         * Headers par défaut
         * @var array
         */
        public static $headers = [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ];

        /**
         * Permet de lancer une requête post vers l'API
         * @param string $url L'url à demander les ressources
         * @param array $data Les données à envoyer
         * @param array $vars Les variables à passer dans le callback
         * @param \Closure $callback La fonction callback à appeler
         */
        public static function post(string $url, array $data, array $vars = [], array $headers = [], $callback = null)
        {
            $headers = array_merge([
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ], $headers);

            $content = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                    'content' => http_build_query($data)
                ]
            ]);

            $result = file_get_contents($url, false, $content);
            $reponse = json_decode($result);

            return !empty($callback) ? $callback($reponse, $vars) : $reponse;
        }

        /**
         * Permet de lancer une requête POST vers l'API pour uploader un fichier
         * @param string $url L'url à lancer la requête
         * @param string $filename Le name de l'input du fichier
         * @param array $vars Les variables à passer dans le callback
         * @param \Closure $callback La fonction callback à appeler
         */
        public static function postFile(string $url, string $filename, array $vars = null, $callback = null)
        {
            $cfile = new \CURLFile(
                $_FILES[$filename]['tmp_name'],
                $_FILES[$filename]['type'],
                $_FILES[$filename]['name']
            );

            $data = [$filename => $cfile];
            
            $curl = curl_init($url);
            curl_setopt_array($curl, [
                CURLOPT_POST, true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => $data
            ]);

            $response = curl_exec($curl);

            if ($response === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
                $response = null;
            }
            
            curl_close($curl);

            $result = json_decode($response);

            if ($callback !== null) {
                return $callback($result, $vars);
            }else {
                return $result;
            }
        }

        /**
         * Permet de lancer une requête get vers l'API
         * @param string $url L'url à demander les données
         * @param array $vars Les variables à passer dans le callaback
         * @param \Closure $callback La fonction callback à appeler
         * @return void|object
         */
        public static function get(string $url, array $vars = [], array $headers = [], $callback = null)
        {
            $headers = array_merge([
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ], $headers);

            $content = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => $headers
                ]
            ]);

            $result = file_get_contents($url, false, $content);
            $reponse = json_decode($result);

            return !empty($callback) ? $callback($reponse, $vars) : $reponse;
        }

        /**
         * Permet de lancer une requête PUT vers l'API
         * @param string $url L'url à lancer la requête
         * @param array $data Les données à envoyer
         * @param array $vars Les variables à passer dans le callback
         * @param \Closure $callback
         * @return void|object
         */
        public static function put(string $url, array $data = [], array $vars = [], $callback = null)
        {
            $headers = array_merge([
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ], $headers);

            $content = stream_context_create([
                'http' => [
                    'method' => 'PUT',
                    'header' => $headers,
                    'content' => http_build_query($data)
                ]
            ]);

            $result = file_get_contents($url, false, $content);
            $reponse = json_decode($result);

            return !empty($callback) ? $callback($reponse, $vars) : $reponse;
        }

        /**
         * Permet de lancer une requête DELETE (de suppression) vers l'API
         * @param string $url L'url à lancer la requête
         * @param array $data Les données à envoyer
         * @param array $vars Les variables à passer dans la callback
         * @param \Closure $callback
         * @return void|object
         */
        public static function delete(string $url, array $data = [], array $vars = [], $callback = null)
        {
            $headers = array_merge([
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ], $headers);

            $content = stream_context_create([
                'http' => [
                    'method' => 'DELETE',
                    'header' => $headers,
                    'content' => http_build_query($data)
                ]
            ]);

            $result = file_get_contents($url, false, $content);
            $reponse = json_decode($result);

            return !empty($callback) ? $callback($reponse, $vars) : $reponse;
        }
    }
