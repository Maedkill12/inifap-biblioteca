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
        // The DB doesnt have autoincrement, so we need to get the last id and add 1 to it.
        $stmt = $this->pdo->prepare("SELECT id FROM public.pub_cientificas ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        $id = $result['id'] + 1;
        $stmt = $this->pdo->prepare("INSERT INTO public.pub_cientificas (id,publicacion,liga,muestra,cuenta,ano,mensaje,publicacionot) VALUES ($id,?,?,?,?,?,?,?)");
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
                "id" => $this->pdo->lastInsertId()
            ];
        }
        return [];
    }

    public function findOne(array $body): array
    {
        [$id] = $body;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_cientificas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        }
        return [];
    }

    public function findMany(array $body): array
    {
        // We can find many articles by year, search, or a combination of both,
        // so if the body contains a key named 'year' or 'keyword' we will use it,
        // otherwise we will return all the articles. But also we need to consider the limit and page
        // parameters, so we will use them if they are present in the body.
        $year = $body['year'] ?? null;
        $search = $body['search'] ?? null;
        $limit = $body['limit'] ?? 10;
        $page = $body['page'] ?? 1;
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_cientificas WHERE ano = ? OR publicacion LIKE ? LIMIT ? OFFSET ?");
        $stmt->execute([$year, "%$search%", $limit, $offset]);
        $result = $stmt->fetchAll();
        if ($result) {
            return $result;
        }
        return [];
    }

    public function update(array $body): array
    {
        [$id, $publicacion, $liga, $muestra, $cuenta, $ano, $mensaje, $publicacionot] = $body;
        // We need only to update the article if it exists, so we will check it first and
        // we only update the values that are present in the body.
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_cientificas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            // We will update only the values that are present in the body.
            $publicacion = $publicacion ?? $result['publicacion'];
            $liga = $liga ?? $result['liga'];
            $muestra = $muestra ?? $result['muestra'];
            $cuenta = $cuenta ?? $result['cuenta'];
            $ano = $ano ?? $result['ano'];
            $mensaje = $mensaje ?? $result['mensaje'];
            $publicacionot = $publicacionot ?? $result['publicacionot'];
            // Now we update the article.
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
                    "id" => $id
                ];
            }
        }
        return [];
    }

    public function delete(array $body): array
    {
        [$id] = $body;
        // We need only to delete the article if it exists, so we will check it first.
        $stmt = $this->pdo->prepare("SELECT * FROM public.pub_cientificas WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            // Now we delete the article.
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
                    "publicacionot" => $result['publicacionot']
                ];
            }
        }

        return [];
    }
}
