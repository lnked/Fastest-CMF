import { CpanelPage } from './app.po';

describe('cpanel App', function() {
  let page: CpanelPage;

  beforeEach(() => {
    page = new CpanelPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
