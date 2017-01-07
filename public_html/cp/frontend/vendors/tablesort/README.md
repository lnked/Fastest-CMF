# Tablesort package for Bower

This package uses JQuery and Underscore to sort tables by clicking on the TH, based on the text-content of the corresponding TD. To make a column sortable, add the class "sortable" to the ```html <th> ```.
Like so:

```html
<table>
  <thead>
    <tr>
      <th class="sortable">Title</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        ...
      </td>
    </tr>
  </tbody>
</table>
```

# Installation
Add
```js
require('tablesort/assets/scripts/tablesort');
```
to your javascript file.
Add
```css
@import 'tablesort/assets/styles/tablesort';
```
to your (s)css file.