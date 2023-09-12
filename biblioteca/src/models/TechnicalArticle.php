<?php

namespace Inifap\Biblioteca\Models;

use Inifap\Biblioteca\Models\Model;

class TechnicalArticle extends Model
{


    public function __construct()
    {
        parent::__construct();
    }

    public function create(array $body): array
    {
        ["publicacion" => $publicacion, "imagen" => $imagen, "liga" => $liga, "muestra" => $muestra, "cuenta" => $cuenta, "ano" => $ano, "mensaje" => $mensaje] = $body;
        $stmt = $this->pdo->prepare("INSERT INTO public.pub_tecnicas (publicacion,liga,muestra,cuenta,ano,mensaje,imagen) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$publicacion, $liga, $muestra, $cuenta, $ano, $mensaje, $imagen]);
        if ($stmt->rowCount() > 0) {
            return [
                "publicacion" => $publicacion,
                "liga" => $liga, "muestra" =>
                $muestra, "cuenta" => $cuenta,
                "ano" => $ano,
                "mensaje" => $mensaje,
                "imagen" => $imagen,
                "id" => $this->pdo->lastInsertId()
            ];
        }
        return [];
    }

    public function findOne(array $body): array
    {
        ["id" => $id] = $body;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_tecnicas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        }
        return [];
    }

    public function findMany(array $body): array
    {

        $year = $body['year'] ?? null;
        $search = $body['search'] ?? null;
        $limit = $body['limit'] ?? 10;
        $page = $body['page'] ?? 1;
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_tecnicas WHERE ano = ? OR publicacion LIKE ? LIMIT ? OFFSET ?");
        $stmt->execute([$year, "%$search%", $limit, $offset]);
        $result = $stmt->fetchAll();
        if ($result) {
            return $result;
        }
        return [];
    }

    public function update(array $body): array
    {
        $id = $body['id'];
        $publicacion = $body['publicacion'] ?? null;
        $liga = $body['liga'] ?? null;
        $muestra = $body['muestra'] ?? null;
        $cuenta = $body['cuenta'] ?? null;
        $ano = $body['ano'] ?? null;
        $mensaje = $body['mensaje'] ?? null;
        $imagen = $body['imagen'] ?? null;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_tecnicas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $publicacion = $publicacion ?? $result['publicacion'];
            $liga = $liga ?? $result['liga'];
            $muestra = $muestra ?? $result['muestra'];
            $cuenta = $cuenta ?? $result['cuenta'];
            $ano = $ano ?? $result['ano'];
            $mensaje = $mensaje ?? $result['mensaje'];
            $imagen = $imagen ?? $result['imagen'];
            $stmt = $this->pdo->prepare("UPDATE public.pub_tecnicas SET publicacion = ?, liga = ?, muestra = ?, cuenta = ?, ano = ?, mensaje = ?, imagen = ? WHERE id = ?");
            $stmt->execute([$publicacion, $liga, $muestra, $cuenta, $ano, $mensaje, $imagen, $id]);
            if ($stmt->rowCount() > 0) {
                return [
                    "publicacion" => $publicacion,
                    "liga" => $liga, "muestra" =>
                    $muestra, "cuenta" => $cuenta,
                    "ano" => $ano,
                    "mensaje" => $mensaje,
                    "imagen" =>
                    $imagen,
                    "id" => $id
                ];
            }
        }
        return [];
    }

    public function delete(array $body): array
    {
        ["id" => $id] = $body;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_tecnicas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $stmt = $this->pdo->prepare("DELETE FROM public.pub_tecnicas WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                return [
                    "id" => $id,
                    "publicacion" => $result['publicacion'],
                    "liga" => $result['liga'],
                    "muestra" => $result['muestra'],
                    "cuenta" => $result['cuenta'],
                    "ano" => $result['ano'],
                    "mensaje" => $result['mensaje'],
                    "imagen" => $result['imagen']
                ];
            }
        }

        return [];
    }
}
