function display_all_images()
        {
            var all = document.getElementById("all_img");
    
            for (var i = 1; i <= 35; i++)
            {
                var img_box = document.createElement("div");

                var image_container = document.createElement("div");

                var image = document.createElement("img");

                var img_options = document.createElement("div");

                var like_button = document.createElement("button");
                var like_icon = document.createElement("i");
                var like_icon_p2 = document.createElement("span"); 
                var like_icon_p3 = document.createTextNode("favorite")

                // ----------

                //- column for row

                img_box.classList.add("align-self-center");
                img_box.classList.add("col-md-6");
                img_box.classList.add("col-lg-3");
            
                //- image container (dark box)

                image_container.classList.add("image_container");


                //- image

                image.src = "images/Wallpaper - " + i + ".jpg";
                image.alt = "IMAGE" + i;
                image.classList.add("image");
                image.classList.add("img-fluid");

                //- image options below img

                img_options.classList.add("image_options");

                //-

                like_button.classList.add("nav_buttons_icon");

                like_icon.classList.add("like_button");
                like_icon.classList.add("material-icons-more");

                like_icon_p2.classList.add("material-symbols-outlined");


                // ----------

                all.appendChild(img_box);

                img_box.appendChild(image_container);

                image_container.appendChild(image);

                image_container.appendChild(img_options);

                img_options.appendChild(like_button);
                like_button.appendChild(like_icon);
                like_icon.appendChild(like_icon_p2);
                like_icon_p2.appendChild(like_icon_p3);

            }
    
        }
