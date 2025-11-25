<?php require_once __DIR__ . '/inicio-html.php';?>
        <main class="container">

            <form class="container__formulario" enctype="multipart/form-data" action="/editado" method="post">
                <h2 class="formulario__titulo">Edite as informacoes do vídeo!</h3>
                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="url">Link embed</label>
                        <input name="url" class="campo__escrita" value="<?=$videoEdit['url'] ?>" id='url' />
                    </div>


                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input name="titulo" class="campo__escrita" value="<?=$videoEdit['title'] ?>" id='titulo' />
                    </div>
                    
                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="image">Imagem do vídeo</label>
                        <input name="image" accept="image/*" class="campo__escrita" type="file" id='image' />
                    </div>

                    <input type="hidden" name="id" value="<?=$videoEdit['id']?>">

                    <input class="formulario__botao" type="submit" value="Enviar" />
            </form>

        </main>

        </body>

        </html><?php 

