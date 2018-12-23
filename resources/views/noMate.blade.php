1
<button onclick="test()"></button>
<script type="text/javascript">
    function test(){
        history.pushState(null, null, document.URL + '?back');
        window.addEventListener('popstate', function () {
            alert(1);
        });
    }
    //window.onpopstate = function(event) {
    //  alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
    //};

    
</script>