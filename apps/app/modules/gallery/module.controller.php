<?php declare(strict_types = 1);

final class galleryController extends galleryModel
{
    public function listAction()
    {
        # Пагинация
        #
        $pager = $this->pager($this->countItem(), $this->limit);

        # Получение списка
        #
        $articles = $this->listAction(
            # Fields
            array( 'id', 'name', 'system', 'anons', 'date', 'date:date_format:date_seo', 'text:empty:text' ),

            # WHERE
            array( 'visible' => 1 ),

            # GROUP BY
            array( 'id' ),

            # ORDER BY
            array( 'date' => 'desc', 'ord' => 'desc' ),

            # LIMIT
            10
        );

        $list = Q("SELECT * FROM `#_module_gallery`")->all();
        exit(__($list));

        $gallery = [
            ['item' => 1],
            ['item' => 2]
        ];

        return [
            'gallery'   =>  $gallery,
            'pager'     =>  $pager,
            'template'  =>  'index'
        ];
    }

    public function itemAction(galleryItem $item)
    {

        $this->setCache('name', 'value');
        $this->getCache('name');

        // if (!$this->mcache_enable || ($this->caching == 1 && !($articles = $this->getCache('_module_articles_item'))))
        // {
        //     $articles = Q("SELECT `id`, `date`, `name`, `system`, `anons`, `text`, `meta_title`, `meta_robots`, `meta_keywords`, `meta_description` FROM `#_mdd_articles` WHERE `visible`='1' AND `id`=?i", array( $item ))->row();
        //     $articles['date'] = Dates($articles['date'], $this->locale);
        
        //     $this->setCache('_module_articles_item', $articles);
        // }

        # Мета теги
        #
        $meta = $this->metaData($gallery);

        $gallery = [
            'item' => $id
        ];

        # Хлебные крошки
        #
        $breadcrumbs = array(
            'id'        => $articles['id'],
            'pid'       => '',
            'name'      => stripslashes($articles['name']),
            'sys_name'  => $articles['system'],
            'link'      => '/' . $this->module_root . '/' . $articles['id'] . '-' . $articles['system']
        );

        return [
            'gallery'   =>  $gallery,
            'template'  =>  'item'
        ];

        return array(
            'meta'          =>  $meta,
            'page'          =>  array( 'name' => '' ),
            'articles'      =>  $articles,
            'breadcrumbs'   =>  $breadcrumbs,
            'template'      =>  'item'
        );
    }
}