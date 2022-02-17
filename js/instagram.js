const feed = $("#instagram-feed");

// jQuery Ajax for feed Instagram Graph API
if (feed.length != 0) {
    const token =
        "IGQVJVelRSbDNIOXIyMURMSU5vdjAtZAW1mcnJjSWJId3JsSWdVUXhLQnlSOE9UUUFLWEtMWm5xOWJyd0tOQkN5TjlOZAXJBMldUWEgzUzBwQTFTV0NIMHlUcGlNWDNNU0VUODVvVnhhaktmajdwQlBoRAZDZD";
    const fields =
        "id,media_type,media_url,thumbnail_url,timestamp,permalink,caption";
    const limit = 6;
    let html = "";

    $.ajax({
        url:
            "https://graph.instagram.com/me/media?fields=" +
            fields +
            "&access_token=" +
            token +
            "&limit=" +
            limit,
        type: "GET",
        success: function (response) {
            const medias = response.data;

            medias.map((media) => {
                console.log(media);
                if (media.media_type === "VIDEO") {
                    html += `<div class="instagram_new">
              <a class="insta-link" href="${media.permalink}" rel="noopener" target="_blank">
                <img src="${media.image_video}" loading="lazy" alt="${media.caption}" class="insta-image" />
              </a>
            </div>`;
                } else {
                    html += `<div class="instagram_new">
            <a class="insta-link" href="${media.permalink}" rel="noopener" target="_blank">
              <img src="${media.media_url}" loading="lazy" alt="${media.caption}" class="insta-image" />
            </a>
          </div>`;
                }
            });

            feed.append(html);
        },
        error: function (error) {
            console.log(error);

            const html = '<div class="class-no-data">No Images Found</div>';
            feed.append(html);
        },
    });
}