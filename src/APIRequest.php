<?php 
	namespace Ekolo\Components\EkoRequest;

	/**
	 * Gère comment envoyer les différentes requêtes http vers l'API
	 */
	class APIRequest
	{
        /**
         * Permet de lancer une requête post vers l'API
         * @param string $url L'url à demander les ressources
         * @param array $data Les données à envoyer
         * @param array $vars Les variables à passer dans le callback
         * @param \Closure $callback La fonction callback à appeler
         */
        public static function post(string $url, array $data, array $vars = null, $callback = null)
        {
            $curl = curl_init($url);

            // CURLOPT_TIMEOUT		   => 5,
            curl_setopt_array($curl, [
                CURLOPT_POST, true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => http_build_query($data)
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
        public static function get(string $url, array $vars = null, $callback = null)
        {
            $curl = curl_init($url);

            // debug($url);
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true
            ]);

            $data = curl_exec($curl);

            if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
                $data = null;
            }

            curl_close($curl);
            
            if ($callback !== null) {
                return $callback(json_decode($data), $vars);
            }else {
                return json_decode($data);
            }
        }

        /**
         * Permet de lancer une requête PUT vers l'API
         * @param string $url L'url à lancer la requête
         * @param array $data Les données à envoyer
         * @param array $vars Les variables à passer dans le callback
         * @param \Closure $callback
         * @return void|object
         */
        public static function put(string $url, array $data = null, $vars = null, $callback = null)
        {
            $content = stream_context_create([
                'http' => [
                    'method' => 'PUT',
                    'header' => [
                        'Accept: application/json',
                        'Content-Type: application/x-www-form-urlencoded'
                    ],
                    'content' => http_build_query($data)
                ]
            ]);

            $result = file_get_contents($url, false, $content);
            $reponse = json_decode($result);

            $callback($reponse, $vars);
        }

        /**
         * Permet de lancer une requête DELETE (de suppression) vers l'API
         * @param string $url L'url à lancer la requête
         * @param array $data Les données à envoyer
         * @param array $vars Les variables à passer dans la callback
         * @param \Closure $callback
         * @return void|object
         */
        public static function delete(string $url, $data = null, $vars = null, $callback = null)
        {
            $content = stream_context_create([
                'http' => [
                    'method' => 'DELETE',
                    'header' => [
                        'Accept: application/json',
                        'Content-Type: application/x-www-form-urlencoded'
                    ],
                    'content' => http_build_query($data)
                ]
            ]);

            $result = file_get_contents($url, false, $content);
            $reponse = json_decode($result);

            if (!empty($callback)) {
                $callback($reponse, $vars);
            }else {
                return $reponse;
            }
            
        }
    }