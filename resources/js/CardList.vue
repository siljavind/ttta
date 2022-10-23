<template>
    <div class="cardlist-container">
        <div class="cardlist-header">
            <img src="http://business.stagingtalenthub.com/images/svg/reward.svg">

            <div class="cardlist-title">
                <div class="title"> {{ title }}</div>
                <div class="subtitle">{{ subtitle }}</div>
            </div>
        </div>

        <div class="feedback-container">
            <div class="feedback-list">
                <h4 style="padding: 0 20px">Question</h4>

                <div class="feedback">
                    <!--{{ averageComputed }}-->
                    <div class="question" v-for="question in questionList.questions" :key="question.id">

                        <div>{{ question.name }}</div>


                        <div class="averageList" v-for="item in averageComputed">
                            <div v-if="item.question_id = question.id">
                                {{ item.question_id }}
                            </div>
                        </div>
                    </div>


                    <div class="score" style="width: 50px; height: 20px; background-color: #1a202c">

                    </div>

                </div>

            </div>


            <!--<div style="width:20%">Score</div>
            <div style="width:20%">Comments</div>-->

        </div>

        <!--
            <div style="display: flex; gap: 10px; flex-direction: column; flex-wrap: wrap">
                <div v-for="reply in replyList" :key="reply.id"
                     style="height: fit-content; width: fit-content; background-color: lightblue">
                    <div v-for="(childItem, key) in reply">
                        <div>
                            {{ childItem }}
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>

</template>

<script>
import axios from 'axios';

export default {
    name: "card-list",
    props: [
        'title',
        'subtitle',

    ],
    data: function () {
        return {
            questionList: {},
            replyList: [],
            //averageList: [],
        }
    },
    methods: {
        getData() {
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e"
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER
            //instance.defaults.responseType = 'json';

            instance.get("/")
                .then(response => {
                    this.questionList = JSON.parse(JSON.stringify(response.data.data));
                }).catch(error => {
            });

            /*instance.get("/replies/bulk", {})
                .then(response => {
                    this.replyList = response.data.data;
                }).catch(error => {
            })*/

        },

        getReplies() {
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e";
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER

            instance.get("/replies/bulk", {})
                .then(response => {
                    this.replyList = response.data.data;
                    //console.log(this.replyList);
                }).catch(error => {
                console.log("reply failed");
            });


        },

        DataToDB() {
            axios.post('http://localhost:8000/question/', {
                question_id: 2,
                name: "fehkfer"
            })
                .then(function (response) {
                console.log(response);
            })
                .then(function (error) {
                console.log(error);
            })
        },

        /*averageMethod() {
            const a = [];
            const avg = [];
            const avgArr = [];
            console.log("got called");
            console.log(this.replyList);
            //reply_list data in array (question_id and value)
            for (let i = 0; i < this.replyList.length; i++) {
                for (let x = 0; x < 4; x++) {
                    a.push(this.replyList[i].reply_questions[x]);
                    console.log("replies exist");
                }
            }

            //Find sum of values by question_id and create new map
            let map = a.reduce((a, b) =>
                a.set(b.question_id, (a.get(b.question_id) || 0) + Number(b.value)), new Map);

            //Convert from Map to Object
            let obj = this.toObject(map);

            //Create an array for each question, calculate the average of value and "reassign" question_id
            for (let [key, value] of Object.entries(obj)) {

                avgArr[key] = {
                    "question_id": key,
                    "value": (Math.round((value / this.replyList.length) * 10) / 10)
                };

                //Push all arrays to returning value
                avg.push(avgArr[key]);
            }
            console.log(avg);
            this.averageList = this.toObject(avg);
        },*/

        toObject(map) {
            let obj = Object.create(null);

            for (let [key, value] of map.entries()) {
                obj[key] = value;
            }
            return obj;
        },

    },
    computed: {
        //averageComputed AKA "I should've just set up the database"
        averageComputed() {
            const a = [];
            const avg = [];
            const avgArr = {};

            //reply_list data in array (question_id and value)
            for (let i = 0; i < this.replyList.length; i++) {
                for (let x = 0; x < 4; x++) {
                    a.push(this.replyList[i].reply_questions[x]);
                }
            }

            //Find sum of values by question_id and create new map
            let map = a.reduce((a, b) =>
                a.set(b.question_id, (a.get(b.question_id) || 0) + Number(b.value)), new Map);

            //Convert from Map to Object
            let obj = this.toObject(map);

            //Create an array for each question
            let i = 0;
            for (let [key, value] of Object.entries(obj)) {

                //Calculate the average of value
                avgArr[i] = {
                    //key: key,
                    value: (Math.round((value / this.replyList.length) * 10) / 10),
                    question_id: key
                };
                //Push all arrays to returning value
                avg.push(avgArr[i]);
                i++;
            }
            //console.log(avgArr);
            return avgArr;
        },

    },
    beforeCreate() {
    },
    beforeMount() {
        this.getReplies();
        this.getData();
    },
    mounted() {
        //console.log(this.questionList);
        this.DataToDB();
        //this.getData();
        //this.getQuestions();
        //this.getReplies();

    },

}
</script>

<style scoped lang="scss">

.cardlist-container {
    width: 100%;

    display: flex;
    flex-direction: column;

    background-color: white;
    //padding: 30px;
    box-shadow: 0 0 15px #0000001F;


    .cardlist-header {
        display: flex;
        height: 15%;
        gap: 10px;
        padding: 20px 20px 0 20px;

        > img {
            height: 50px;
            width: 50px;
        }

        .cardlist-title {
            display: flex;
            flex-direction: column;
            font-family: system-ui;

            > .title {
                font-size: 20px;
                font-weight: 500;
                letter-spacing: -1px;
            }

            > .subtitle {
                font-size: 16px;
                font-weight: 300;
                letter-spacing: -1px;
            }
        }
    }

    .feedback-container {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        height: 100%;

        .feedback-list {
            display: flex;
            flex-direction: column;
            width: 100%;
            min-width: fit-content;

            .feedback {
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
                width: 55%;

                .question {
                    height: 25%;
                    min-width: fit-content;
                    padding: 20px;
                    border-top: #F7F7F7 solid 2px;
                    display: flex;
                    flex-direction: row;
                    flex-wrap: nowrap;
                    justify-content: space-between;

                }
            }

        }
    }


}

</style>
