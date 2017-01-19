import angular from 'angular';

import blockHeadline from '../../components/block.headline';
import blockNews from '../../components/block.news';

import NewsController from './news.controller';

export default angular.module('app.pages.news', [
    blockHeadline.name,
    blockNews.name
])
    .controller(NewsController.name, NewsController);
