@if(isset($templates['calculation'][0]) && $calculation = $templates['calculation'][0])
    <section id="home-banner" style="                background-image: linear-gradient(to right, rgba(56, 80, 129, 0.95), rgba(56, 80, 129, 0.95)), url( {{getFile(config('location.template.path').@$calculation->templateMedia()->image)}});">
        <div class="container">
            <div class="row align-items-center" id="basicCalcInfo">
                <div class="col-xl-7 col-lg-6">
                    <div class="content-wrapper">
                        <div class="banner-heading">
                            <h1>@lang($calculation->description->title)</h1>
                        </div>
                        <div class="paragraph text-white">
                            <p>@lang($calculation->description->short_description)</p>
                        </div>
                        <div class="get-strated">
                            <a href="{{@$calculation->templateMedia()->button_link}}" class="anim-button">
                                <span class="layer1">@lang($calculation->description->button_name)</span>
                                <span class="layer2"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="transfer-form error">
                        <div class="you-send">
                            <div style="background: yellow">


                            </div>
                            <div class="you-send-inner">
                                <div class="send-input">
                                    <label for="send-input">{{trans('You send')}} </label>
                                    <input id="send-input" v-model="send_amount" @change="getValue"
                                           @keypress="onlyNumber"
                                           placeholder="0.00">
                                </div>

                                <div class="choose-currency ">
                                    <select id="s-currency" class="js-example-templating"
                                            @change="onChangeSend($event)">
                                        <option v-for="item in senderCurrencies" :value="item.id"
                                                :data-image="item.flag">@{{ item.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="error-massage" v-if="send_amount < (sendFrom.minimum_amount - 0)">
                                <span>{{trans('The smallest amount you can send is')}} @{{sendFrom.minimum_amount}} @{{sendFrom.code}}</span>
                            </div>
                        </div>

                        <div class="our-fee ">
                            <div class="row justify-content-between my-2">
                                <div class="col-6">
                                    <div class="amount">
											<span class="icon-wrapper">
												<span class="icon"><span>&quest;</span></span>
											</span>
                                        <span>1 @{{sendFrom.code}} = @{{rate}} @{{receiveFrom.code}}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="amount-for">
                                        <span>{{trans('Fee Depend on your service')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="they-get">
                            <div class="they-get-inner">
                                <div class="get-input">
                                    <label for="get-input">{{trans('They Gets')}}</label>
                                    <input type="text" id="get-input" v-model="get_amount" @change="sendValue"
                                           @keypress="onlyNumber">
                                </div>
                                <div class="choose-currency ">
                                    <select id="g-currency" class="js-example-templating"
                                            @change="onChangeReceive($event)">
                                        <option v-for="item in receiverCurrencies" :value="item.id"
                                                :data-image="item.flag">@{{item.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="continue-button large-button mt-2">
                            <a href="javascript:void(0)" @click="goNext">{{trans('Continue')}}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    @push('script')
        <script>
            'use strict';
            new Vue({
                el: "#basicCalcInfo",
                data: {
                    senderCurrencies: [],
                    receiverCurrencies: [],
                    sendFrom: {},
                    receiveFrom: {},
                    send_amount: '',
                    get_amount: '',
                    rate: '',
                },
                beforeMount() {
                    this.currencyList();
                    if (localStorage.getItem('resource') != null) {
                        this.sendFrom = JSON.parse(localStorage.getItem('resource'))
                    }

                },
                mounted() {


                    let self = this;
                    $('#s-currency').select2().on("change", function (e) {
                        self.onChangeSend($(this).val());
                    });
                    $('#g-currency').select2().on("change", function () {
                        self.onChangeReceive(this.value);
                    });

                    $(".js-example-templating").select2({
                        templateSelection: this.formatState
                    });



                },
                methods: {
                    currencyList() {
                        axios.get('{{route('currencyList')}}')
                            .then(res => {
                                this.senderCurrencies = res.data.senderCurrencies
                                this.receiverCurrencies = res.data.receiverCurrencies
                                if (0 < this.senderCurrencies.length) {
                                    this.sendFrom = this.senderCurrencies[0]
                                }
                                if (0 < this.receiverCurrencies.length) {
                                    this.receiveFrom = this.receiverCurrencies[0]
                                }
                                this.getRate()
                            })
                            .catch(err => {
                                console.log(err)
                            });
                    },
                    onChangeSend(id) {
                        var self = this;
                        var arr = self.senderCurrencies;
                        const result = arr.find((obj, index) => {
                            if (obj.id == id) {
                                return true
                            }
                        });
                        this.sendFrom = result

                        this.getRate();
                        this.getValue();
                    },
                    onChangeReceive(id) {
                        var self = this;
                        var arr = self.receiverCurrencies;
                        const result = arr.find((obj, index) => {
                            if (obj.id == id) {
                                return true
                            }
                        });
                        this.receiveFrom = result
                        this.getRate()

                        this.getValue();
                    },
                    onlyNumber($event) {
                        //console.log($event.keyCode); //keyCodes value
                        let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
                        if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
                            $event.preventDefault();
                        }
                    },
                    formatState(state) {
                        if (!state.id) {
                            return state.text;
                        }
                        var image = $(state.element).data('image');
                        var $state = $('<span style="font-size: 16px; margin-left: 8px;"><img src="' + image + '" style="width: 20px;height: 15px;margin-right: 12px;"> <span class="country-code-name">' + state.text + '</span> </span>');
                        return $state;
                    },
                    getRate() {
                        var setRate = this.receiveFrom.rate / this.sendFrom.rate;
                        this.rate = setRate.toFixed(2);
                        return setRate;
                    },
                    getValue() {
                        this.get_amount = (this.send_amount * this.getRate()).toFixed(2)
                        Math.abs(this.get_amount)
                    },
                    sendValue() {
                        this.send_amount = (this.get_amount / this.getRate()).toFixed(2)
                        Math.abs(this.send_amount)
                    },
                    goNext() {
                        var $url = '{{ route("toCountry", "country:slug") }}';
                        $url = $url.replace('country:slug', this.receiveFrom.slug);
                        localStorage.setItem('send_amount', this.send_amount);
                        localStorage.setItem('sendFrom', JSON.stringify(this.sendFrom));
                        localStorage.setItem('receiveFrom', JSON.stringify(this.receiveFrom));

                        localStorage.setItem('sendSelectId', this.sendFrom.id);
                        localStorage.setItem('sendSelectFlag', this.sendFrom.flag);
                        localStorage.setItem('sendSelectName', this.sendFrom.name);
                        localStorage.setItem('sendSelectCode', this.sendFrom.code);
                        localStorage.setItem('resource', JSON.stringify(this.sendFrom));


                        window.location.href = $url
                    }
                }
            });
        </script>

    @endpush
    @push('style')
        <style>
            .select2-container--default .select2-selection--single .select2-selection__rendered::after {
                content: "\ea99";
                font-family: "IcoFont";
                font-size: 16px;
                color: var(--brand-color-alt);
                position: absolute;
                padding-left: 4%;
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                overflow: initial;
                padding-right: 10%;
            }


            #home-banner .get-input, #home-banner .send-input {
                width: 60%;
            }
        </style>
    @endpush

@endif
