class BlockNewsController {
    constructor ($scope) {
        this.$scope = $scope;
        this.tagSelected = false;
        this.activeTag = [];
    }

    _emit (data) {
        if (!this.activeTag.includes(data)) {
            this.activeTag.push(data);
        } else {
            this.activeTag.splice(this.activeTag.indexOf(data), 1);
        }

        if (this.activeTag.length) {
            this.tagSelected = true;
            this.$scope.$emit('newsReloading', this.activeTag);
        } else {
            this.tagSelected = false;
            this.$scope.$emit('newsLoading');
        }

        $('html, body').animate(
            {scrollTop: 0},
        300);
    }

    _checkIfTagIsActive (tag) {
        return this.activeTag.includes(tag);
    }
}
BlockNewsController.$inject = ['$scope'];

export default BlockNewsController;
