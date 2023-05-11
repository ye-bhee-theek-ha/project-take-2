<?php
    
?>

<script>
    var data = <?php echo json_encode($data);?>;
    var num_of_rows  = <?php echo json_encode($num);?>;

    var liked_images = <?php echo json_encode($liked_images);?>;
    var num_of_rows_liked_images  = <?php echo json_encode($num_liked);?>;
                
    var photo_id_of_images = [];
    var user_id_of_images = [];
    var paths_of_images = [];
    var names_of_images = [];
    var desc_of_images = [];
    var total_likes_of_images = [];
    var total_comments_of_images = [];
    var resoultion_of_images = [];
    var size_of_images = [];
    var upload_date = [];
    //--------------------------------

    var current_page_img_details = [];
    var current_page_img_details_tf = [];
    //0=> do nothing 1=like(true) 2=>unlike(false)

    //---------------------------------
    var large_img = false;

    function display_all_images()
        {   
           
            
            for (var i = 0; i < num_of_rows; i++)
            {
                photo_id_of_images[i] = data[i]["photo_id"];
                user_id_of_images[i] = data[i]["user_id"];
                paths_of_images[i] = data[i]["path"];
                names_of_images[i] = data[i]["title"];
                desc_of_images[i] = data[i]["description"];
                total_likes_of_images[i] = data[i]["total_likes"];
                total_comments_of_images[i] = data[i]["total_comments"];
                resoultion_of_images[i] = data[i]["resolution"];
                size_of_images[i] = data[i]["size"];
                upload_date[i] = data[i]["upload_date"];
                
                //keep track of images liked/unliked by user in the current load of page
                current_page_img_details_tf[i] = 0;     //0=> do nothing 1=like(true) 2=>unlike(false)
                current_page_img_details[i] = data[i]["photo_id"];


            }
            
            var all = document.getElementById("all_img");

            // if (//view img true)
            // {
            //     all.classList.add("all_img_when_view_img_true");
            // }
            // else if (//view image false)
            // {
            //     all.classList.remove("all_img_when_view_img_true");
            // }
    
            for (var i = 0; i < num_of_rows; i++)
            {
                var img_box = document.createElement("div");

                var image_container = document.createElement("div");

                var image = document.createElement("img");

                var img_options = document.createElement("div");

                //like
                var like_button_container = document.createElement("div");

                var like_button = document.createElement("button");
                var like_image =document.createElement("img");
                // var like_icon = document.createElement("i");
                // var like_icon_p2 = document.createElement("span"); 
                // var like_icon_p3 = document.createTextNode("favorite");

                var t_likes = document.createElement("p");

                //comment
                var comment_button_container = document.createElement("div");
                
                var comment_button = document.createElement("button");
                var comment_icon = document.createElement("i");
                var comment_icon_p2 = document.createElement("span"); 
                var comment_icon_p3 = document.createTextNode("comment");

                var t_comments = document.createElement("p");


                // ----------

                img_box.classList.add("img_container_outer");

                img_box.classList.add("col-12");
                img_box.classList.add("col-sm-6");
                img_box.classList.add("col-md-4");
                img_box.classList.add("col-lg-3");
                
                        
                //- image container (dark box)
                image_container.classList.add("image_container");

                //- image

                image.addEventListener("click", set_view_image_true); //======================

                image.all = all;
                image.img_box = img_box;
                image.path = paths_of_images[i];
                image.id = photo_id_of_images[i];

                image.src = paths_of_images[i];
                image.alt = "IMAGE" + i;
                image.classList.add("image");
                image.classList.add("img-fluid");

                //- image options below img

                img_options.classList.add("image_options");

                //-
                like_button_container.classList.add("image_button_container");

                like_button.classList.add("nav_buttons_icon");
                like_button.addEventListener("click", change_liked);

                // passing the id of clicked photo to function add_liked through target event property
                like_button.u_id = photo_id_of_images[i];   //to get photo id of image
                like_button.img_num = i;                    //to get selected image
                like_button.current_img_div = like_image;   //to change the image
                like_button.total_likes_div = t_likes;


                like_image.classList.add("like_image");
                
                // checking if image liked or not
                if (liked_images.includes(photo_id_of_images[i]))
                {
                    like_image.src = "img_assets/liked.png";

                    // used for passing to function
                    like_button.like_unlike = false;     // if true then like else unlike
                }
                else
                {
                    like_image.src = "img_assets/like.png";

                    // used for passing to function
                    like_button.like_unlike = true;     // if true then like else unlike
                }

                like_image.alt = "like_img";
                
                t_likes.classList.add("total_likes");
                t_likes.innerHTML = total_likes_of_images[i];
                like_button.total_likes = total_likes_of_images[i];
                //-
                comment_button_container.classList.add("image_button_container");

                comment_button.classList.add("nav_buttons_icon");

                comment_icon.classList.add("like_button");
                comment_icon.classList.add("material-icons-more");

                comment_icon_p2.classList.add("material-symbols-outlined");

                t_comments.classList.add("total_comments")
                t_comments.innerHTML = total_comments_of_images[i];
                
                // ----------

                all.appendChild(img_box);

                img_box.appendChild(image_container);

                image_container.appendChild(image);

                //if (//view_img is true and window,width > large)
                {
                    image_container.appendChild(img_options);

                    img_options.appendChild(like_button_container);
                    like_button_container.appendChild(like_button);
                    like_button.appendChild(like_image);
                    
                    //if (//window.width > medium)
                    {
                        like_button_container.appendChild(t_likes);
                    }
                    

                    img_options.appendChild(comment_button_container);
                    comment_button_container.appendChild(comment_button);
                    comment_button.appendChild(comment_icon);
                    comment_icon.appendChild(comment_icon_p2);
                    comment_icon_p2.appendChild(comment_icon_p3);

                    //if (//window.width > medium)
                    {
                        comment_button_container.appendChild(t_comments);
                    }
                }

            }
    
        }

    function set_view_image_true(evt)
        {
            var xhr = new XMLHttpRequest();
            var comment_info = [evt.currentTarget.id];

            xhr.open("POST", "scripts/comments.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            // sending to php (below)
            xhr.send(JSON.stringify(comment_info));
            console.log(comment_info);

            var view_img = document.getElementById("view_img");
            var img_box = document.getElementsByClassName("img_container_outer");
            var img_view = document.getElementById("image_view");

            img_view.src = evt.currentTarget.path;

            // showing large image
            for(var i = 0; img_box[i]; i++)
            {
                img_box[i].classList.add("col-12");
                img_box[i].classList.add("col-sm-6");
                img_box[i].classList.add("col-md-6");
                img_box[i].classList.add("col-lg-4");
            }

            view_img.style.display = "flex";
            view_img.classList.remove("view_img");

            all = document.getElementById("all_img");
            all.classList.add("col-6");
            all.classList.remove("col-12");
        }

    function set_view_image_false(all)
        {
            
        }

    function view_img_container(img_box)
        {
            img_box.classList.add("align-self-center");
            img_box.classList.add("col-md-3");
            img_box.classList.add("col-lg-3");
        }

    function no_view(img_box)
        {
            img_box.classList.add("align-self-center");
            img_box.classList.add("col-md-6");
            img_box.classList.add("col-lg-3");
        }

            function display_comments()
        {

        }

    function change_liked(evt)
        {
            // id of liked image => evt.currentTarget.u_id
            // state of image => evt.currentTarget.like_unlike

            // console.log(evt.currentTarget.u_id);
            // console.log(evt.currentTarget.like_unlike);

            var i = evt.currentTarget.img_num;

            //console.log(current_page_img_details_tf[i]);
            console.log(i + " => " + evt.currentTarget.total_likes);
            

            if (current_page_img_details_tf[i] != 0)
            {
                //this basically checks if image is already (in the already loaded page) liked then pressing it again will unlike otherwise it will act based on the last act on that like button
                if (current_page_img_details_tf[i] == 1)
                {
                    evt.currentTarget.like_unlike = false;     // if true then like else unlike
                    console.log("unliking " + i);
                }
                else if(current_page_img_details_tf[i] == 2)
                {
                    evt.currentTarget.like_unlike = true;     // if true then like else unlike
                    console.log("liking " + i);
                }
            }
            
            if (evt.currentTarget.like_unlike)
            {
                evt.currentTarget.current_img_div.src = "img_assets/liked.png";
                total_likes_of_images[i]++;
            }
            else
            {
                evt.currentTarget.current_img_div.src = "img_assets/like.png";
                total_likes_of_images[i]--;
            }

            console.log("upadted =>" + total_likes_of_images[i])

            //updating on the screen
            evt.currentTarget.total_likes_div.innerHTML = total_likes_of_images[i];
            
            var xhr = new XMLHttpRequest();
            var like_info = [evt.currentTarget.u_id, evt.currentTarget.like_unlike, total_likes_of_images[i]] 

            xhr.open("POST", "scripts/update_liked.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            // sending to php (below)
            xhr.send(JSON.stringify(like_info));
            
            // saving the change in array so we can instantly show it and when user presses it again we chan change accordingly
            if(evt.currentTarget.like_unlike)
            {
                current_page_img_details_tf[i] = 1;
            }
            else
            {
                current_page_img_details_tf[i] = 2;
            }
            

            <?php 
                //include "get_liked_info.php";
            ?>
        }


</script>


