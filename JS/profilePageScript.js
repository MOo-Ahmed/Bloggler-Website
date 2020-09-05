let showAllPostsBtn = document.getElementById('showAllPosts');
let timelineSection = document.querySelector('.timeline');

$(document).ready(function(){
    function fetchPostsFromDB(){
        $.ajax({
            url: 'processShowAllPosts.php',
            type: 'POST',
            success: function(data){
                var res = JSON.parse(data);
                showPosts(res);
            }
        });
    }

    function showPosts(data){
        var i = 0 ;
        for (; i < data.length; i++) {
            var  timelineSection = document.querySelector('.timeline');
            var tempPost = document.createElement("div");
            tempPost.className = 'post';
            var header = document.createElement("div");
            header.className = "post-header" ;
            tempPost.appendChild(header);
            var content = document.createElement("div") ;
            content.className = "post-content" ;
            tempPost.appendChild(content);
            var username = document.createElement("span");
            username.className = "username" ;
            var date = document.createElement("span") ;
            date.className = "date" ;
            header.appendChild(username);
            header.appendChild(date) ;
            username.innerHTML = data[i].Name ;
            date.innerHTML = data[i].PostDate ;
            content.innerHTML = data[i].Body ;
            timelineSection.appendChild(tempPost) ;
        }
    }

    $(document).on('click', '#showAllPosts', function(){
        fetchPostsFromDB();
    });
});