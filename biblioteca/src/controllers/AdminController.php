<?php

namespace Inifap\Biblioteca\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(string $secretKey): void
    {
        header("Content-Type: application/json");
        if ($this->authenticate($secretKey)) {
            $this->createSession();
            $this->regenerateSessionId();
            $this->bindSessionToIpAddress();
            header("status: 200");
            echo json_encode(["status" => "success", "message" => "Logged in"]);
        } else {
            header("status: 401");
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
        }
    }

    private function authenticate($secretKey)
    {
        $storedKey = $_ENV["API_KEY"];
        return $secretKey === $storedKey;
    }

    private function createSession()
    {
        $_SESSION["logged_in"] = true;
        $_SESSION["expires_at"] = time() + 60 * 60; // 1 hour expiration time
        $_SESSION["ip_address"] = $_SERVER["REMOTE_ADDR"];
    }

    private function regenerateSessionId(): void
    {
        session_regenerate_id(true);
    }

    private function bindSessionToIpAddress(): void
    {
        $_SESSION["ip_address"] = $_SERVER["REMOTE_ADDR"];
    }

    public function isSessionValid()
    {
        if (!isset($_SESSION["logged_in"]) || !isset($_SESSION["expires_at"]) || !isset($_SESSION["ip_address"])) {
            return false;
        }
        if ($_SESSION["logged_in"] === true && $_SESSION["expires_at"] > time() && $_SESSION["ip_address"] === $_SERVER["REMOTE_ADDR"]) {
            return true;
        }
        return false;
    }

    public function isAuth(): void
    {
        if (!$this->isSessionValid()) {
            header("Location: " . ROOT_PATH . "/admin/login");
            exit();
        }
    }

    public function logout(): void
    {
        session_destroy();
        header("Content-Type: application/json");
        header("status: 200");
        echo json_encode(["status" => "success", "message" => "Logged out"]);
        exit();
    }
}
