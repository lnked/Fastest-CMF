<?php

return [
    'name' => 'News',
    'description' => 'Simple form one',
    'core' => '6.x'
];


// name = RSS Feeds
// description = Makes a compact page to navigate on RSS feeds.
// package = «RSS»
// core = 7.x
// version = «7.x-1.0»
// configure = admin/config/content/rss_feeds
// files[]= rss_feeds.module

// name — имя модуля, которое будет отображаться в админке;
// description — описание модуля, которое подскажет администратору, что делает этот модуль;
// package — указывает категорию, в которой будет отображен модуль на странице модулей;
// core — версия Drupal, под которую он разрабатывался;
// version — версия нашего модуля;
// configure — путь, по которому будет доступна страница настроек модуля;
// files[] — массив подключаемых модулем файлов;


function rss_feeds_uninstall()
{
    cache_clear_all('rss_feeds', 'cache', TRUE);
    drupal_uninstall_schema('rssfeeds');
    menu_rebuild();
}

function rss_feeds_schema()
{
    $schema['rssfeeds'] = array(
        'fields'      => array(
            'id'         => array('type' => 'serial',  'size'=>'normal',  'not null' => TRUE),
            'name'       => array('type' => 'varchar', 'length' => 255, 'not null' => TRUE),
            'url'        => array('type' => 'varchar', 'length' => 255, 'not null' => TRUE),
            'created_at' => array('type' => 'int', 'not null' => TRUE),
            'updated_at' => array('type' => 'int', 'not null' => TRUE),
        ),
        'primary key' => array('id')
    );

    return $schema;
}

function module_installer()
{
    // Ñòàíäàðòíûé òåêñò
    $output = '<h2>Äîáðî ïîæàëîâàòü â óñòàíîâùèê ìîäóëÿ CatFace!</h2>';
    $output .= '<img class="module_image" src="/engine/skins/images/catface.png" />';
    $output .= '<p><strong>Âíèìàíèå!</strong> Ïîñëå óñòàíîâêè ìîäóëÿ <strong>îáÿçàòåëüíî</strong> óäàëèòå ôàéë <strong>catface_installer.php</strong> ñ Âàøåãî ñåðâåðà!</p>';

    // Åñëè ÷åðåç $_POST ïåðåäà¸òñÿ ïàðàìåòð catface_install, ïðîèçâîäèì èíñòàëëÿöèþ, ñîãëàñíî ïàðàìåòðàì
    if(!empty($_POST['catface_install']))
    {
        // Ïîäêëþ÷àåì config
        include_once ('engine/data/config.php');

        // Ïîäêëþ÷àåì DLE API
        include ('engine/api/api.class.php');

        // Óäàëåíèå òàáëèöû ñ òàêèì æå íàçâàíèåì (åñëè ñóùåñòâóåò)
        $query = "DROP TABLE IF EXISTS `".PREFIX."_category_face`;";
        $dle_api->db->query($query);

        // Cîçäàíèå òàáëèöû äëÿ ìîäóëÿ
        $query = "CREATE TABLE `".PREFIX."_category_face` (
                      `category_id` int(11) NOT NULL,
                      `name` varchar(255) NOT NULL,
                      `name_pages` varchar(255) NOT NULL,
                      `description` text NOT NULL,
                      `description_pages` text NOT NULL,
                      `module_placement` enum('nowhere','first_page','all_pages') NOT NULL,
                      `show_name` enum('show','default','hide') NOT NULL,
                      `show_description` enum('show','default','hide') NOT NULL,
                      `name_placement` enum('first_page','all_pages') NOT NULL,
                      `description_placement` enum('first_page','all_pages') NOT NULL,
                      PRIMARY KEY (`category_id`)
                    ) DEFAULT CHARSET=cp1251;";
        $dle_api->db->query($query);

        // Óñòàíàâëèâàåì ìîäóëü â àäìèíêó
        $dle_api->install_admin_module('catface', 'CatFace - SEO îïòèìèçàöèÿ êàòåãîðèé', 'Ìîäóëü ïîçâîëÿåò ïðèêðåïèòü ê êàòåãîðèÿì è ãëàâíîé ñòðàíèöå îïèñàíèå è çàãîëîâîê, à òàê æå ðåãóëèðîâàòü èõ âûâîä íà ðàçíûõ ñòðàíèöàõ', 'catface.png');

        // Âûâîä
        $output .= '<p>';
        $output .= 'Ìîäóëü óñïåøíî óñòàíîâëåí! Ñïàñèáî çà Âàø âûáîð! Ïðèÿòíîé ðàáîòû!';
        $output .= '</p>';
    }

    // Åñëè ÷åðåç $_POST íè÷åãî íå ïåðåäà¸òñÿ, âûâîäèì ôîðìó äëÿ óñòàíîâêè ìîäóëÿ
    else
    {
        // Âûâîä
        $output .= '<p>';
        $output .= '<form method="POST" action="catface_installer.php">';
        $output .= '<input type="hidden" name="catface_install" value="1" />';
        $output .= '<input type="submit" value="Óñòàíîâèòü ìîäóëü" />';
        $output .= '</form>';
        $output .= '</p>';
    }
    
    $output .= '<p>';
    $output .= '<a href="http://alaev.info/blog/post/2086?from=CatFaceInstaller">ðàçðàáîòêà è ïîääåðæêà ìîäóëÿ</a>';
    $output .= '</p>';

    // Ôóíêöèÿ âîçâðàùàåò òî, ÷òî äîëæíî áûòü âûâåäåíî
    return $output;
}