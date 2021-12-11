
<audio id="myNotify">
    <source src="{{asset('assets/admin/css/notify.mp3')}}" type="audio/mpeg">
</audio>

<div class="dropdown account-dropdown dropdown--notify custom--dropdown ml-auto ml-sm-3 mr-4" id="pushNotificationArea">
    <a class="dropdown-toggle-btn ">
								<span class="rotate-icon">
									<i class="icofont-alarm"></i>
								</span>
        <span class="badge">@{{items.length}}</span>
    </a>
    <div class="dropdown-content scrolling-iv drop-l-content">
        <a class="dropdown-item" v-for="(item, index) in items" @click.prevent="readAt(item.id, item.description.link)"  href="javascript:void(0)" >
            <div class="media align-items-center">
                <div class="media-icon">
                    <i :class="item.description.icon" ></i>
                </div>
                <div class="media-body ml-15">

                    <h6 class="font-weight-bold " v-cloak v-html="item.description.text"></h6>
                    <p v-cloak>@{{ item.formatted_date }}</p>
                </div>
            </div>
        </a>

        <div class="pt-15 pr-15 pb-15 pl-15 d-flex justify-content-between">
            <a class="btn-viewnotification mt-2 ml-2" href="javascript:void(0)" v-if="items.length == 0">@lang('You have no notifications')</a>
            <button class="btn-clear float-right m-2" type="button" v-if="items.length > 0" @click.prevent="readAll">@lang('Clear All')</button>
        </div>
    </div>
</div>


@push('script')

    @auth
        <script>
            'use strict';
            let pushNotificationArea = new Vue({
                el: "#pushNotificationArea",
                data: {
                    items: [],
                },
                beforeMount() {
                    this.getNotifications();
                    this.pushNewItem();
                },
                methods: {
                    getNotifications() {
                        let app = this;
                        axios.get("{{ route('user.push.notification.show') }}")
                            .then(function (res) {
                                app.items = res.data;
                            })
                    },
                    readAt(id, link) {
                        let app = this;
                        let url = "{{ route('user.push.notification.readAt', 0) }}";
                        url = url.replace(/.$/, id);
                        axios.get(url)
                            .then(function (res) {
                                if (res.status) {
                                    app.getNotifications();
                                    if (link != '#') {
                                        window.location.href = link
                                    }
                                }
                            })
                    },
                    readAll() {
                        let app = this;
                        let url = "{{ route('user.push.notification.readAll') }}";
                        axios.get(url)
                            .then(function (res) {
                                if (res.status) {
                                    app.items = [];
                                }
                            })
                    },
                    pushNewItem() {
                        let app = this;
                        // Pusher.logToConsole = true;
                        let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                            encrypted: true,
                            cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                        });
                        let channel = pusher.subscribe('user-notification.' + "{{ Auth::id() }}");
                        channel.bind('App\\Events\\UserNotification', function (data) {
                            app.items.unshift(data.message);
                            var x = document.getElementById("myNotify");
                            x.play();
                        });
                        channel.bind('App\\Events\\UpdateUserNotification', function (data) {
                            app.getNotifications();
                        });
                    }
                }
            });
        </script>
    @endauth
@endpush




