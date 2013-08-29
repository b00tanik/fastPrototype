<?php
/**
 * User: b00tanik
 * Date: 04.07.11
 * Time: 2:03
 */

class Main extends Controller {

    const POST_PER_PAGE = 5;

    public function show() {
        $pm = new PostModel();

        if(!isset($_GET['page'])) $_GET['page']=1;
        $_GET['page']=intval($_GET['page']);

        $posts = iterator_to_array($pm->findAll()->skip(($_GET['page']-1)*self::POST_PER_PAGE)->limit(self::POST_PER_PAGE));
        $counter = new CountersStorage();
        $pages = ceil($counter->get('post')/self::POST_PER_PAGE);

        return array('posts'=>$posts, 'pages'=>$pages);
    }
}
