<?php

require_once "../../includes/conexaoPdo.php";

const IMAGE_HANDLERS = [
    IMAGETYPE_JPEG => [
        'load' => 'imagecreatefromjpeg',
        'save' => 'imagejpeg',
        'quality' => 100
    ],
    IMAGETYPE_PNG => [
        'load' => 'imagecreatefrompng',
        'save' => 'imagepng',
        'quality' => 0
    ]
];

class Arquivos extends ConexaoPdo
{

    private $novo_arquivo;
    private $nome_amigavel;
    private $arquivo_atual;
    private $pasta;
    private $largura_thumb;
    private $altura_thumb;
    private $retorno_arquivo;
    private $erro;

    /* =============== FUNÇÃO INSERE ARQUIVO =============== */

    public function insere_arquivo()
    {

        if (isset($this->novo_arquivo['name']) && $this->novo_arquivo['error'] == 0) {
            $arquivo_tmp = $this->novo_arquivo['tmp_name'];
            $nome = $this->novo_arquivo['name'];
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            $novoArquivo = $this->nome_amigavel . '-' . date("YmdHi") . "." . $extensao;
            $novoArquivoWebp = $this->nome_amigavel . '-' . date("YmdHi") . ".webp";
            $novoArquivoThumb = $this->nome_amigavel . '-' . date("YmdHi") . '-thumb.' . $extensao;
            $caminho_pasta = '../uploads/' . $this->pasta . '/';
            $destino = $caminho_pasta . $novoArquivo;
            if (!is_dir($caminho_pasta)) {
                mkdir($caminho_pasta, 0775, true);
            }
            if (@move_uploaded_file($arquivo_tmp, $destino)) {
                /*CONSULTAR O TAMANHO DA THUMB*/
                $this->consulta_tamanho_thumb();
                if ($this->getLargura_thumb() != "" || $this->getLargura_thumb() != null) {
                    /*GERA A THUMBNAIL */
                    $this->createThumbnail($destino, $caminho_pasta . $novoArquivoThumb, $this->getLargura_thumb(), $this->getAltura_thumb());
                    /* VERIFICA SE É UMA IMAGEM GIF */
                    if ($extensao !== "gif") {
                        /*CONVERTE A THUMBNAIL PARA WEBP*/
                        $this->webpImage($caminho_pasta . $novoArquivoThumb, 90, true);
                    }
                    /*RETORNA PARA O CONTROLLER O NOME DO ARQUIVO PARA INSERIR AO BANCO*/
                    $this->retorno_arquivo = "$novoArquivo";
                } else {
                    /* VERIFICA SE É UMA IMAGEM GIF */
                    if ($extensao !== "gif") {
                        /*CONVERTE A IMAGEM PARA WEBP*/
                        $this->webpImage($destino, 90, true);
                        /*RETORNA PARA O CONTROLLER O NOME DO ARQUIVO PARA INSERIR AO BANCO*/
                        $this->retorno_arquivo = "$novoArquivoWebp";
                    } else {
                        $this->retorno_arquivo = "$novoArquivo";
                    }
                }
                $this->erro = 0;
                $this->excluir_arquivo();
            }
        } else if ($this->novo_arquivo['error'] == 1) {
            $this->retorno_arquivo = "$this->arquivo_atual";
            $this->erro = 1;
        } else if ($this->novo_arquivo['error'] == 2) {
            $this->retorno_arquivo = "$this->arquivo_atual";
            $this->erro = 2;
        } else if ($this->novo_arquivo['error'] == 4) {
            $this->retorno_arquivo = "$this->arquivo_atual";
            $this->erro = 4;
        }
    }

    /* =============== FUNÇÃO REMOVE ARQUIVO =============== */

    public function excluir_arquivo()
    {
        if ($this->arquivo_atual) {

            /*EXCLUI IMAGEM CASO ELA EXISTA*/
            if (file_exists("../uploads/$this->pasta/" . $this->arquivo_atual)) {
                unlink("../uploads/$this->pasta/" . $this->arquivo_atual);
            }

            /*EXCLUI IMAGEM THUMB CASO ELA EXISTA*/
            $arquivo_atual_webp = explode(".", $this->arquivo_atual);
            if (file_exists("../uploads/$this->pasta/" . $arquivo_atual_webp[0] . "-thumb.webp")) {
                unlink("../uploads/$this->pasta/" . $arquivo_atual_webp[0] . "-thumb.webp");
            }
        }
    }

    /* =============== FUNÇÃO CONSULTA TAMANHO DA THUMBNAIL =============== */

    private function consulta_tamanho_thumb()
    {

        try {
            $pdo = parent::getDB();

            $consulta_tamanho_thumb = $pdo->prepare("
                SELECT
                    largura_thumb,
                    altura_thumb
                FROM
                    tamanho_imagens
                WHERE
                    tabela = ?
            ");
            $consulta_tamanho_thumb->execute(
                array(
                    "$this->pasta"
                )
            );
            if ($consulta_tamanho_thumb->rowCount() > 0):
                $resultado = $consulta_tamanho_thumb->fetch(PDO::FETCH_OBJ);
                $this->setLargura_thumb($resultado->largura_thumb);
                $this->setAltura_thumb($resultado->altura_thumb);
                return true;
            else:
                $this->setLargura_thumb("");
                $this->setAltura_thumb("");
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO QUE CRIA A THUMBNAIL =============== */
    private function createThumbnail($src, $dest, $targetWidth, $targetHeight = null)
    {

        // 1. Load the image from the given $src
        // - see if the file actually exists
        // - check if it's of a valid image type
        // - load the image resource

        // get the type of the image
        // we need the type to determine the correct loader
        $type = exif_imagetype($src);

        // if no valid type or no handler found -> exit
        if (!$type || !IMAGE_HANDLERS[$type]) {
            return null;
        }

        // load the image with the correct loader
        $image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);

        // no image found at supplied location -> exit
        if (!$image) {
            return null;
        }


        // 2. Create a thumbnail and resize the loaded $image
        // - get the image dimensions
        // - define the output size appropriately
        // - create a thumbnail based on that size
        // - set alpha transparency for PNGs
        // - draw the final thumbnail

        // get original image width and height
        $width = imagesx($image);
        $height = imagesy($image);

        // maintain aspect ratio when no height set
        if ($targetHeight == null) {

            // get width to height ratio
            $ratio = $width / $height;

            // if is portrait
            // use ratio to scale height to fit in square
            if ($width > $height) {
                $targetHeight = floor($targetWidth / $ratio);
            }
            // if is landscape
            // use ratio to scale width to fit in square
            else {
                $targetHeight = $targetWidth;
                $targetWidth = floor($targetWidth * $ratio);
            }
        }

        // create duplicate image based on calculated target size
        $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

        // set transparency options for PNGs
        if ($type == IMAGETYPE_PNG) {

            // make image transparent
            imagecolortransparent(
                $thumbnail,
                imagecolorallocate($thumbnail, 0, 0, 0)
            );

            // additional settings for PNGs
            if ($type == IMAGETYPE_PNG) {
                imagealphablending($thumbnail, false);
                imagesavealpha($thumbnail, true);
            }
        }

        // copy entire source image to duplicate image and resize
        imagecopyresampled(
            $thumbnail,
            $image,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $width,
            $height
        );


        // 3. Save the $thumbnail to disk
        // - call the correct save method
        // - set the correct quality level

        // save the duplicate version of the image to disk
        return call_user_func(
            IMAGE_HANDLERS[$type]['save'],
            $thumbnail,
            $dest,
            IMAGE_HANDLERS[$type]['quality']
        );
    }

    /* =============== CONVERTER IMAGEM PARA WEBP =============== */
    private function webpImage($source, $quality = 100, $removeOld = false)
    {
        $dir = pathinfo($source, PATHINFO_DIRNAME);
        $name = pathinfo($source, PATHINFO_FILENAME);
        $destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info = getimagesize($source);
        $isAlpha = false;
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } else if ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($source);

        // return $destination;
    }

    /* =============== GETTERS E SETTERS =============== */

    function getNovo_arquivo()
    {
        return $this->novo_arquivo;
    }

    function getNome_amigavel()
    {
        return $this->nome_amigavel;
    }

    function getArquivo_atual()
    {
        return $this->arquivo_atual;
    }

    function getPasta()
    {
        return $this->pasta;
    }

    function getLargura_thumb()
    {
        return $this->largura_thumb;
    }

    function getAltura_thumb()
    {
        return $this->altura_thumb;
    }

    function getRetorno_arquivo()
    {
        return $this->retorno_arquivo;
    }

    function getErro()
    {
        return $this->erro;
    }

    function setNovo_arquivo($novo_arquivo)
    {
        $this->novo_arquivo = $novo_arquivo;
    }

    function setNome_amigavel($nome_amigavel)
    {
        $this->nome_amigavel = $nome_amigavel;
    }

    function setArquivo_atual($arquivo_atual)
    {
        $this->arquivo_atual = $arquivo_atual;
    }

    function setPasta($pasta)
    {
        $this->pasta = $pasta;
    }

    function setLargura_thumb($largura_thumb)
    {
        $this->largura_thumb = $largura_thumb;
    }

    function setAltura_thumb($altura_thumb)
    {
        $this->altura_thumb = $altura_thumb;
    }

    function setRetorno_arquivo($retorno_arquivo)
    {
        $this->retorno_arquivo = $retorno_arquivo;
    }

    function setErro($erro)
    {
        $this->erro = $erro;
    }
}