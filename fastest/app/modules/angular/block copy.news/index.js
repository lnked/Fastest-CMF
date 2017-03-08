import angular from 'angular';
import 'moment';
import 'angular-moment';

import BlockNewsController from './block.news.controller';
import BlockNewsDirective from './block.news.directive';

const blockNews = angular.module('app.components.block.news', ['angularMoment'])
    .controller(BlockNewsController.name, BlockNewsController)
    .directive('shBlockNews', BlockNewsDirective);

export default blockNews;
