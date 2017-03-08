import angular from 'angular';

appNewsStates.$inject = ['$stateProvider'];

function appNewsStates ($stateProvider) {
    $stateProvider
      .state('root.news', {
          url: '/news',
          views: {
              content: {
                  controller: 'NewsController as vm',
                  templateProvider: ['$q', ($q) => {
                      return $q((resolve) => {
                          require.ensure([], () => {
                              resolve(require('./news.jade'));
                          }, 'news');
                      });
                  }]
              }
          },
          resolve: {
              loadModule: ['$q', '$ocLazyLoad', ($q, $ocLazyLoad) => {
                  return $q((resolve) => {
                      require.ensure([], () => {
                          $ocLazyLoad.load({name: require('./index').name});
                          resolve();
                      }, 'news');
                  });
              }]
          }
      });
}

export default angular.module('app.routes.news', [])
    .config(appNewsStates);
