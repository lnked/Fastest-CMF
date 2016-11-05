<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>


    {if $_csrf_token nocache}
    <meta content="{$_csrf_param}" name="csrf-param">
    <meta content="{$_csrf_token}" name="csrf-token">
    {/if}
    
</head>
<body>
    <header>
        <h1>HEADER 1</h1>
    </header>
    
    <div>{$smarty.session.authenticity_token}</div>

    <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>10</li>
    </ul>
    <footer>
        xxx asd yy
    </footer>
</body>
</html>