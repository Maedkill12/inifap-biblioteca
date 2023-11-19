<?php

namespace Inifap\Biblioteca\Models;

use Inifap\Biblioteca\Models\Model;

class ScientificArticle extends Model
{


    public function __construct()
    {
        parent::__construct();
    }

    public function create(array $body): array
    {
        ["publicacion" => $publicacion, "liga" => $liga, "muestra" => $muestra, "cuenta" => $cuenta, "ano" => $ano, "mensaje" => $mensaje, "publicacionot" => $publicacionot] = $body;
        $stmt = $this->pdo->prepare("INSERT INTO public.pub_cientificas (publicacion,liga,muestra,cuenta,ano,mensaje,publicacionot) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$publicacion, $liga, $muestra, $cuenta, $ano, $mensaje, $publicacionot]);
        if ($stmt->rowCount() > 0) {
            return [
                "publicacion" => $publicacion,
                "liga" => $liga, "muestra" =>
                $muestra, "cuenta" => $cuenta,
                "ano" => $ano,
                "mensaje" => $mensaje,
                "publicacionot" =>
                $publicacionot,
                "id" => $this->pdo->lastInsertId(),
                "categoria" => "cientifico"
            ];
        }
        return [];
    }

    public function findOne(array $body): array
    {
        ["id" => $id] = $body;
        $stmt = $this->pdo->prepare("SELECT *, 'cientifico' as categoria, 'cientifico.png' AS imagen FROM public.pub_cientificas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $result['recomendaciones'] = $this->getRecommendations($id);
            return $result;
        }
        return [];
    }

    public function findMany(array $body): array
    {
        $year = $body['year'] ?? null;
        $search = strtolower($body['search'] ?? "");
        $search = urldecode($search);
        // if search is a number, search by year
        if (is_numeric($search)) {
            $year = $search;
        }
        $limit = $body['limit'] ?? 9;
        $page = $body['page'] ?? 1;
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT *, 'cientifico' AS categoria, 'cientifico.png' AS imagen FROM public.pub_cientificas WHERE ano = ? OR LOWER(publicacion) LIKE ? LIMIT ? OFFSET ?");
        $stmt->execute([$year, "%$search%", $limit, $offset]);
        $result = $stmt->fetchAll();
        if ($result) {
            return $result;
        }
        return [];
    }

    public function recents(): array
    {
        $stmt = $this->pdo->prepare("SELECT *, 'cientifico' AS categoria, 'cientifico.png' AS imagen FROM public.pub_cientificas ORDER BY ano DESC LIMIT 5");
        $stmt->execute();
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
        $publicacionot = $body['publicacionot'] ?? null;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_cientificas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $publicacion = $publicacion ?? $result['publicacion'];
            $liga = $liga ?? $result['liga'];
            $muestra = $muestra ?? $result['muestra'];
            $cuenta = $cuenta ?? $result['cuenta'];
            $ano = $ano ?? $result['ano'];
            $mensaje = $mensaje ?? $result['mensaje'];
            $publicacionot = $publicacionot ?? $result['publicacionot'];
            $stmt = $this->pdo->prepare("UPDATE public.pub_cientificas SET publicacion = ?, liga = ?, muestra = ?, cuenta = ?, ano = ?, mensaje = ?, publicacionot = ? WHERE id = ?");
            $stmt->execute([$publicacion, $liga, $muestra, $cuenta, $ano, $mensaje, $publicacionot, $id]);
            if ($stmt->rowCount() > 0) {
                return [
                    "publicacion" => $publicacion,
                    "liga" => $liga, "muestra" =>
                    $muestra, "cuenta" => $cuenta,
                    "ano" => $ano,
                    "mensaje" => $mensaje,
                    "publicacionot" =>
                    $publicacionot,
                    "id" => $id,
                    "categoria" => "cientifico"
                ];
            }
        }
        return [];
    }

    public function delete(array $body): array
    {
        ["id" => $id] = $body;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_cientificas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            $stmt = $this->pdo->prepare("DELETE FROM public.pub_cientificas WHERE id = ?");
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
                    "publicacionot" => $result['publicacionot'],
                    "categoria" => "cientifico"
                ];
            }
        }

        return [];
    }

    protected function getRecommendations(string $id): array
    {
        $sql = "SELECT *, 'cientifico' as categoria, 'cientifico.png' AS imagen FROM public.pub_cientificas 
        WHERE id != ?
        AND (
            publicacion LIKE (SELECT CONCAT('%', (string_to_array(publicacion, ' '))[1], '%') FROM public.pub_cientificas WHERE id = ?) OR
            publicacion LIKE (SELECT CONCAT('%', (string_to_array(publicacion, ' '))[2], '%') FROM public.pub_cientificas WHERE id = ?)
        )
        LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id, $id, $id]);
        $result = $stmt->fetchAll();
        if ($result) {
            return $result;
        }
        return [];
    }
}
