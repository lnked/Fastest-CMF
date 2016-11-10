var app = app || {};

(function(body){
    "use strict";

    // // Prepare
    // var History = window.History; // Note: We are using a capital H instead of a lower h
    // if ( !History.enabled ) {
    //      // History.js is disabled for this browser.
    //      // This is because we can optionally choose to support HTML4 browsers or not.
    //     return false;
    // }

    // // Bind to StateChange Event
    // History.Adapter.bind(window,'statechange',function() { // Note: We are using statechange instead of popstate
    //     var State = History.getState();
    //     $('#content').load(State.url);
    //     /* Instead of the line above, you could run the code below if the url returns the whole page instead of just the content (assuming it has a `#content`): */
    //     $.get(State.url, function(response) {
    //         $('#content').html($(response).find('#content').html()); });
    //     });


    // // Capture all the links to push their url to the history stack and trigger the StateChange Event
    // $('a').click(function(evt) {
    //     evt.preventDefault();
    //     History.pushState(null, $(this).text(), $(this).attr('href'));
    // });

    app.history = {
        
        navi: null,

        wrap: null,

        init: function()
        {
            var _this_ = this, _url_ = null;

            _this_.navi = $(".j-ajax-link");
            _this_.wrap = $("#content");

            _this_.navi.on('click', function(e){
                e.preventDefault();
                
                _url_ = $(this).attr('href');
                
                _this_.navi.filter('.is-current').removeClass('is-current');
                _this_.navi.filter('[href="'+_url_+'"]').addClass('is-current');

                window.history.pushState({}, null, _url_);
            });

            console.log(window.History);

            // function requestContent(file) {
            //   $('.wrapper__content').load(file + ' .wrapper__content');
            // }

            // window.addEventListener('popstate', function(e) {
            //   var character = e.state;

            //   if (character == null) {
            //     removeCurrentClass();
            //     textWrapper.innerHTML = " ";
            //     content.innerHTML = " ";
            //     document.title = defaultTitle;
            //   } else {
            //       updateText(character);
            //       requestContent(character + ".html");
            //       addCurrentClass(character);
            //       document.title = "Ghostbuster | " + character;
            //   }
            // });

            // 

            // Bind to StateChange Event
            // History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
            //     var State = History.getState(); // Note: We are using History.getState() instead of event.state
            // });

            // // // Change our States
            // History.pushState({state:1}, "State 1", "?state=1"); // logs {state:1}, "State 1", "?state=1"
            // History.pushState({state:2}, "State 2", "?state=2"); // logs {state:2}, "State 2", "?state=2"
            // History.replaceState({state:3}, "State 3", "?state=3"); // logs {state:3}, "State 3", "?state=3"
            // History.pushState(null, null, "?state=4"); // logs {}, '', "?state=4"
            // History.back(); // logs {state:3}, "State 3", "?state=3"
            // History.back(); // logs {state:1}, "State 1", "?state=1"
            // History.back(); // logs {}, "Home Page", "?"
            // History.go(2); // logs {state:3}, "State 3", "?state=3"
            
            return false;

            /*  Инициализируем контейнер для записей */
            var $entries = $(".wrapper__content");

            /* Вешаем обработчики onlick на ссылки */
            var $page_links = $(".nav"),
                $prev_link = $page_links.find("a.nav__item__link"),
                $next_link = $page_links.find("a.nav__item__link");
            $page_links.delegate("a", "click", function (e) {
                e.preventDefault();
                var url = $(this).attr("href");

                /*  Удаляем текущие записи из контейнера */
                $entries.empty();

                /*  Показываем индикатор загрузки */
                $entries.addClass("loading");

                /*  И сообщаем History.js об изменении состояния страницы
                В качестве первого агрумента можно передать произвольный объект
                с дополнительными данными, которые можно извлечь в обработчике
                изменения состояния, описанном ниже.
                В нашем случае это будет пустой объект. */
                window.history.pushState({}, null, url);
            });

            /*  Готовим обработчик изменения состояния страницы */
            window.history.Adapter.bind(window, "statechange", function () {
                /*  Получаем информацию о состоянии страницы */
                var state = window.history.getState();

                /* Получаем URL нового состояния. Это URL, который мы передали
                в .pushState() */
                var url = state.url;

                /*  Тут можно извлечь дополнительные данные, о которых шла речь выше.
                Например, так: var data = state.data; */

                /*  Отправляем AJAX-запрос на сервер.
                В качестве ответа мы ожидаем JSON-объект следующего формата:
                {entries: "<article><h1>...</h1>...</article> <article>...",
                 title: "Страница 3",
                 next_url: "/blog/page/4",
                 prev_url: "/blog/page/2" }
                Каким образом будет сформирован этот ответ, зависит только от вас. */
                $.getJSON(url, function (response) {

                    /*  Обновляем заголовок страницы */
                    $("title").text(response.title);

                    /*  Обновляем ссылки на предыдущую и следующую страницы */
                    $prev_link.attr("href", response.prev_url);
                    $next_link.attr("href", response.next_url);

                    /*  И, наконец, показываем новый блок записей */
                    $entries.removeClass("loading").html(response.entries);
                });
            });
        }

    };

})(document.body);

// (function(window,undefined){

//     // Check Location
//     if ( document.location.protocol === 'file:' ) {
//         alert('The HTML5 History API (and thus History.js) do not work on files, please upload it to a server.');
//     }

//     // Establish Variables
//     var
//         History = window.History, // Note: We are using a capital H instead of a lower h
//         State = History.getState(),
//         $log = $('#log');

//     // Log Initial State
//     History.log('initial:', State.data, State.title, State.url);

//     // Bind to State Change
//     History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
//         // Log the State
//         var State = History.getState(); // Note: We are using History.getState() instead of event.state
//         History.log('statechange:', State.data, State.title, State.url);
//     });

//     // Prepare Buttons
//     var
//         buttons = document.getElementById('buttons'),
//         scripts = [
//             'History.pushState({state:1,rand:Math.random()}, "State 1", "?state=1"); // logs {state:1,rand:"some random value"}, "State 1", "?state=1"',
//             'History.pushState({state:2,rand:Math.random()}, "State 2", "?state=2"); // logs {state:2,rand:"some random value"}, "State 2", "?state=2"',
//             'History.replaceState({state:3,rand:Math.random()}, "State 3", "?state=3"); // logs {state:3,rand:"some random value"}, "State 3", "?state=3"',
//             'History.pushState(null, null, "?state=4"); // logs {}, "", "?state=4"',
//             'History.back(); // logs {state:3}, "State 3", "?state=3"',
//             'History.back(); // logs {state:1}, "State 1", "?state=1"',
//             'History.back(); // logs {}, "The page you started at", "?"',
//             'History.go(2); // logs {state:3}, "State 3", "?state=3"'
//         ],
//         buttonsHTML = ''
//         ;

//     // Add Buttons
//     for ( var i=0,n=scripts.length; i<n; ++i ) {
//         var _script = scripts[i];
//         buttonsHTML +=
//             '<li><button onclick=\'javascript:'+_script+'\'>'+_script+'</button></li>';
//     }
//     buttons.innerHTML = buttonsHTML;

// })(window);