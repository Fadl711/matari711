import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT || 8080,
    forceTLS: false,
});

// الاستماع للتعليقات الجديدة
window.Echo.channel('comments')
    .listen('NewCommentPosted', (data) => {
       console.log(data);
    });


function addCommentToDOM(comment) {
                            $('#comment_input').val('');

                        // Prepend the new comment to the comments section
                        var newComment = `
                            <div class="border border-r-emerald-500">
                                <div class="flex w-full justify-between border rounded-md">
                                    <div class="p-3">
                                        <div class="flex gap-3 items-center">
                                            <img src="${response.user_img}" class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400 shadow-emerald-400">
                                            <h3 class="font-bold">
                                                ${response.user_name}
                                                <br>
                                            </h3>
                                        </div>
                                        <p class="text-gray-600 mt-2">
                                            ${response.comment}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;

                        $('.overflow-y-scroll').prepend(newComment);
}
