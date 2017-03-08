import BlockNewsController from './block.news.controller';
import blockNewsHtml from './block.news.jade';

function BlockNewsDirective () {
    return {
        restrict: 'AE',
        scope: {
            news: '=',
            tags: '='
        },
        controller: BlockNewsController.name,
        controllerAs: 'newsCtrl',
        bindToController: true,
        template: blockNewsHtml
    };
}

BlockNewsDirective.$inject = [];

export default BlockNewsDirective;
