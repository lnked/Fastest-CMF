class NewsController {
    constructor ($rootScope, $scope, $timeout) {
        this.$rootScope = $rootScope;
        this.$scope = $scope;
        this.$timeout = $timeout;

        this.smallText = 'SmartHeart®';
        this.bigText = 'Life Talks Inspiration Experience';

        /* eslint-disable */
        this.newsObj = Parse.Object.extend('News');
        this.newsQuery = new Parse.Query(this.newsObj);

        this.tagsObj = Parse.Object.extend('NewsParameter');
        this.tagsQuery = new Parse.Query(this.tagsObj);
        /* eslint-enable */

        this.newsQuery.limit(12)
            .find((news) => {
                this.news = this.newsBackup = news;

                news.forEach((article, index) => {
                    const category = article.relation('category');
                    /* eslint-disable */
                    category.query().find((tags) => {
                        this.news[index].tags = [];

                        tags.forEach((tag) => {
                            this.news[index].tags.push(tag.attributes.Category);
                        });
                    });
                    /* eslint-enable */
                });
            }).then(() => {
                this.$timeout(() => {
                    this.$rootScope.dataIsLoaded = true;
                }, this.$rootScope.pageLoadingTimeout);

                this.$rootScope.pageTitle = 'News';
                this.$rootScope.pageDescription = '';
                this.$rootScope.pageImage = this.news[0].attributes.ImagePreview._url;
            });

        this.tagsQuery
            .find((tags) => {
                this.tags = tags;
            });

        this.$scope.$on('newsReloading', (event, data) => {
            this._load(data);
        });
        this.$scope.$on('newsLoading', () => {
            this.news = [];

            this.$timeout(() => {
                this.news = this.newsBackup;
            }, 500);
        });
    }

    _load (tags) {
        this.news = [];

        this.$timeout(() => {
            for (const article of this.newsBackup) {
                console.log(article);
                for (const tag of tags) {
                    if (article.tags.includes(tag) && !this.news.includes(article)) {
                        this.news.push(article);
                    }
                }
            }
        }, 500);
    }
}

NewsController.$inject = ['$rootScope', '$scope', '$timeout'];

export default NewsController;
