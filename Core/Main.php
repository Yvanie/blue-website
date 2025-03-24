<?php

namespace BleuWebsite\Core;

use Dotenv\Dotenv;
use BleuWebsite\Controllers\ErrorController;

/**
 * Main class
 *
 * This class is responsible for handling requests and routing them to the appropriate controllers.
 *
 * @namespace BleuWebsite\Core
 * @autor Yvanie Noelle
 */
class Main
{
    /**
     * CONTROLLERS namespace constant
     *
     * @var string
     */
    private const CONTROLLERS_NAMESPACE = "\BleuWebsite\\Controllers\\";

    /**
     * Starts the application
     *
     * This method starts the session, gets the request path, and routes the request to either an API request or a web request.
     */
    public function start(): void
    {
        
        $this->startSession();

        // Load environment variables
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        // Check the STATUS environment variable
        if ($_ENV['STATUS'] === 'BUILDING') {
            $this->handleBuildingStatus();
            return;
        } else {
            // Remove the STATUS session variable if it exists
            if (isset($_SESSION['STATUS'])) {
                unset($_SESSION['STATUS']);
            }
        }

        $requestPath = $this->getRequestPath();
        

        if ($this->isApiRequest($requestPath)) {
            $this->handleApiRequest($requestPath);
        } else {
            $this->handleWebRequest();
        }
    }

    /**
     * Starts the session
     *
     * This method starts the session if it's not already started.
     */
    private function startSession(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Gets the request path
     *
     * This method parses the request URI, trims the slashes, and explodes the path into an array.
     *
     * @return array
     */
    private function getRequestPath(): array
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        $path = explode('/', $path);

        if ($_ENV['ENVIRONNEMENT'] === 'DEVELOPPEMENT') {
            $path = array_slice($path, 1);
        }
        
        // Process the third segment of the path
        if (isset($path[2])) {
            if (is_numeric($path[2])) {
                // If it's a numeric value, leave it as is
                $path[2] = (int) $path[2];
            } else {
                // If it's in the form of key:value, convert to associative array
                $params = [];
                parse_str(str_replace(':', '=', $path[2]), $params);
                $path[2] = $params;
            }
        }
        

        return $path;
    }

    /**
     * Checks if the request is an API request
     *
     * This method checks if the request path has more than one segment.
     *
     * @param array $requestPath
     * @return bool
     */
    private function isApiRequest(array $requestPath): bool
    {
        return count($requestPath) > 1;
    }

    /**
     * Handles API requests
     *
     * This method handles API requests by instantiating the controller, calling the method, and returning the response in JSON format.
     *
     * @param array $requestPath
     */
    private function handleApiRequest(array $requestPath): void
    {
        $controllerName = ucfirst($requestPath[0]) . 'Controller';

        $class = self::CONTROLLERS_NAMESPACE . $controllerName;
        $methodName = ucfirst($requestPath[1]);
        if (!$this->controllerExists($class)) {
            http_response_code(404);
            
            exit();
        }

        $controller = new $class;

        if (!$this->methodExists($controller, $methodName)) {
            http_response_code(404);
            echo "Method not found";
            exit();
        }

        $parameters = $this->getParameters($requestPath);

        $response = call_user_func_array([$controller, $methodName], $parameters);

        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    /**
     * Handles web requests
     *
     * This method handles web requests by instantiating the controller and calling the setRender method.
     */
    private function handleWebRequest(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $publicPath = '/Public/';

        // Redirection pour /admin
        if (strpos($requestUri, '/admin') === 0) {
            header('Location: /index.php?p=login');
            exit();
        }

        // Check if the request URI starts with /Public/
        if (strpos($requestUri, $publicPath) === 0) {
            $this->serveStaticFile($requestUri);
            return;
        }

        $page = $_GET['p'] ?? 'Home';
        
        $controllerName = self::CONTROLLERS_NAMESPACE . ucfirst($page) . 'Controller';
        

        if (!$this->controllerExists($controllerName)) {
            http_response_code(404);
            
            exit();
        }

        $controller = new $controllerName;
        
        $controller->setRender();
    }

    /**
     * Serves static files from the /Public/ directory
     *
     * @param string $requestUri
     */
    private function serveStaticFile(string $requestUri): void
    {
        // Remove the /Public/ prefix to get the file path
        $filePath = str_replace('/Public/', '', $requestUri);
        $fullPath = dirname(__DIR__) . '/Public/' . $filePath;

        // Check if the file exists and is readable
        if (file_exists($fullPath) && is_readable($fullPath)) {
            // Serve the file
            $mimeType = mime_content_type($fullPath);
            header('Content-Type: ' . $mimeType);
            readfile($fullPath);
            exit();
        } else {
            // File not found
            http_response_code(404);
            echo "File not found";
            exit();
        }
    }


    /**
     * Checks if a controller exists
     *
     * This method checks if a controller class exists.
     *
     * @param string $controllerName
     * @return bool
     */
    private function controllerExists(string $controllerName): bool
    {
        return class_exists($controllerName);
    }

    /**
     * Checks if a method exists
     *
     * This method checks if a method exists in a controller.
     *
     * @param object $controller
     * @param string $methodName
     * @return bool
     */
    private function methodExists(object $controller, string $methodName): bool
    {
        return method_exists($controller, $methodName);
    }

    /**
     * Gets the parameters for the controller method
     *
     * This method gets the parameters for the controller method from the request path or the query string.
     *
     * @param array $requestPath
     * @return array
     */
    private function getParameters(array $requestPath): array
    {
        if (isset($requestPath[2])) {
            return [$requestPath[2]];
        }

        return array_values($requestPath);
    }

    /**
     * Handles requests when the status is BUILDING
     *
     * This method redirects the request to the ComingController.
     */
    private function handleBuildingStatus(): void
    {
        $controllerName = self::CONTROLLERS_NAMESPACE . 'ComingController';

        if (!$this->controllerExists($controllerName)) {
            http_response_code(404);
            $controller = new ErrorController;
            $controller->setRender();
            exit();
        }

        // Set a session variable to indicate BUILDING status
        $_SESSION['STATUS'] = 'BUILDING';

        $controller = new $controllerName;
        $controller->setRender();
    }
}
