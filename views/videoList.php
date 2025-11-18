<?php require_once __DIR__ . '/inicio-html.php';
        ?>
            <ul class="videos__container" alt="videos alura">
                <?php foreach ($videoList as $video):?>
                <li class="videos__item">
                    <iframe width="100%" height="72%" src="<?= $video->url ?>" title="Conhecendo a linguagem Go | Hipsters.Talks"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <div class="descricao-video">
                        <img src="./img/logo.png" alt="logo canal alura">
                        <h3><?= $video->title ?></h3>
                        <div class="acoes-video">
                            <a href="/editar-video?id=<?=$video->id ?>">Editar</a>
                            <form action="/remover-video" method="post" style="display:inline">
                                <input type="hidden" name="id" value="<?=$video->id?>">
                                <button type="submit">Excluir</button>
                            </form>
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>

            </body>

            </html>