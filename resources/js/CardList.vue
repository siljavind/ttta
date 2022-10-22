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
                    <div class="question" v-for="question in questionList.questions" :key="question.id">
                        <div>{{ question.name }}</div>
                    </div>
                    <div v-for="items in replyList" style="margin-bottom: 50px">
                        <div v-for="item in items.reply_questions">
                            <!--{{scoreAverage}}--> {{item}}
                        </div>
                    </div>

                    <div class="score" style="width: 50px; height: 20px; background-color: #1a202c">

                    </div>

                </div>

            </div>


            <!--<div style="width:20%">Score</div>
            <div style="width:20%">Comments</div>-->

        </div>

        <!--<div style="height: fit-content; width:100%; gap: 10px; background-color: #2d3748; display: flex;">


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
import {isProxy, toRaw} from 'vue';

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
            averageScore: [],
        }
    },
    methods: {
        getQuestions() {
            var that = this;
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e"
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER
            instance.defaults.responseType = 'json';
            instance.get("/")
                .then(response => {
                    this.questionList = JSON.parse(JSON.stringify(response.data.data));
                    //console.log(JSON.parse(JSON.stringify(response.data.data)));
                    //console.log(JSON.parse(JSON.stringify(this.questionList.data.questions)));
                    //console.log(this.questionList);
                }).catch(error => {
            });
        },

        getReplies() {

            var that = this;
            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e";
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER
            instance.get("/replies/bulk", {})
                .then(response => {
                    this.replyList = response.data.data;

                    //let json = JSON.parse(JSON.stringify(response.data.data));
                    //let json = response.data.data;
                    //console.log(json);
                }).catch(error => {
            });

        },
    },
    /*computed: {
        scoreAverage() {
            var scoreSum;

            for (let i = 0; i < this.replyList.length; i++) {
                scoreSum += this.replyList[i].reply_questions[i].value;
                console.log(i);
            }
            console.log(scoreSum);
            return scoreSum;
        }
    },*/
    mounted() {
        this.getQuestions();
        this.getReplies();
    }
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
