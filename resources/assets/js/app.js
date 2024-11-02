import './bootstrap';

(function () {
    console.log(document.querySelector('#calendar'))

    var cal = new Calendar(document.querySelector('#calendar'), {
        defaultView: 'month'
    });
})();

