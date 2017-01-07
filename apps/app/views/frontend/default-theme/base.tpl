{strip}
{include file="./components/meta.inc.tpl"}

<main>
    <header>
        <nav>
            <a href="/"{if !$app.controller} class="is-current"{/if}>Главная</a>
            <a href="/hello"{if $app.controller == 'hello'} class="is-current"{/if}>Приветствие</a>
            <a href="/news"{if $app.controller == 'news' && !isset($app.action)} class="is-current"{/if}>Новости</a>
            <a href="/news/10"{if $app.controller == 'news' && isset($app.action) && $app.action == 10} class="is-current"{/if}>Новость элемент</a>
            <a href="/articles"{if $app.controller == 'articles' && !isset($app.action)} class="is-current"{/if}>Статьи</a>
            <a href="/articles/test"{if $app.controller == 'articles' && isset($app.action) && $app.action == 'test' && !isset($app.params)} class="is-current"{/if}>Статьи категория</a>
            <a href="/articles/test/20"{if $app.controller == 'articles' && isset($app.action) && $app.action == 'test' && isset($app.params) && in_array(20, $app.params)} class="is-current"{/if}>Статьи элемент категории</a>
            <strong><a href="/cp" target="_blank">Админка</a></strong>
        </nav>
    </header>

    <section>
        <aside>
            
        </aside>
        
        <article>
            <div class="content">
                <pre>
                {if is_array($app.content)}
                    {$app.content|print_r}
                {else}
                    {$app.content}
                {/if}
                </pre>
            </div>
        </article>
    </section>
</main>

<footer>
    FOOTER
</footer>

{include file="./components/scripts.inc.tpl"}
{/strip}