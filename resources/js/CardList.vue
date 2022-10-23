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
                <div style="display: flex">
                    <h4 style="display: flex; justify-content: center; font-family: system-ui; font-weight: 500; width:50%">Question</h4>
                    <h4 style="display: flex; justify-content: center; font-family: system-ui; font-weight: 500; width:25%">Score(s)</h4>
                    <h4 style="display: flex; justify-content: center; font-family: system-ui; font-weight: 500; width:25%">Comments</h4>
                </div>

                <div class="feedback">
                    <div class="question" v-for="question in subArray" :key="question.id">

                        <div style="width:50%">{{ question.name }}</div>
                        <div style="width:5%;">
                            <img src="http://business.stagingtalenthub.com/images/svg/rating-outline.svg" alt="">
                        </div>

                        <div class="averageList" v-for="item in averageList">
                            <div style="font-size: 14px">{{ question.question_id }}</div>
                            <div style="font-size: 14px">{{ item.question_id }}</div>
                            <div style="font-size: 14px">{{ item.value }}</div>
                        </div>

                        <div style="width:25%; display: flex; justify-content: flex-end">
                            <img src="http://business.stagingtalenthub.com/images/svg/comment.svg" alt="">
                        </div>
                    </div>

                    <div v-if="questionList.question_id = averageList.question_id"> HHHHH</div>

                </div>

            </div>

        </div>


        <!--<div style="width:20%">Score</div>
        <div style="width:20%">Comments</div>-->


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
            questionList: [],
            replyList: [],
            averageList: [],
            count: 0
        }
    },
    methods: {
        getData() {
            //Shouldn't be in this file

            const instance = axios.create();

            instance.defaults.baseURL = "https://business.stagingtalenthub.com/api/measurements/ab8b76b28aeb494992c47466fea7e49e"
            instance.defaults.headers.common["Authorization"] = import.meta.env.VITE_TALENTHUB_TOKEN; //IS EXPOSED TO USER
            //instance.defaults.responseType = 'json';

            instance.get("/")
                .then(response => {
                    this.QuestionsToDB(response.data.data);
                }).catch(error => {
                //console.log(error);
            });

            instance.get("/replies/bulk", {})
                .then(response => {
                    this.RepliesToDB(response.data.data);
                }).catch(error => {
                //console.log(error);
            })

        },

        QuestionsToDB(list) {
            //Shouldn't be in this file

            for (let i = 0; i < list.questions.length; i++) {

                axios.post('http://localhost:8000/question', {
                    question_id: list.questions[i].id,
                    name: list.questions[i].name
                })
                    .then(function (response) {
                        //console.log(response);
                    })
                    .then(function (error) {
                        // console.log(error);
                    })
            }
        },

        getQuestions() {
            axios.get('http://localhost:8000/question/list', {})
                .then(response => {
                    this.questionList = response.data.data;
                }).catch(error => {
                //console.log(error);
            })
        },
        RepliesToDB(list) {
            //Shouldn't be in this file

            for (let i = 0; i < list.length; i++) {
                for (let x = 0; x < list[x].reply_questions.length; x++) {

                    axios.post('http://localhost:8000/replies', {
                        question_id: list[i].reply_questions[x].question_id,
                        value: list[i].reply_questions[x].value
                    })
                        .then(function (response) {
                            //console.log(response);
                        })
                        .then(function (error) {
                            // console.log(error);
                        })
                }

            }
        },

        getReplies() {
            axios.get('http://localhost:8000/replies/list', {})
                .then(response => {
                    this.replyList = response.data;
                    // console.log("getReply");
                    // console.log(this.replyList);
                    this.averageMethod(this.replyList);
                }).catch(error => {
                //console.log(error);
            })

        },

        averageMethod(list) {
            const a = list.data;
            const avg = [];
            const avgArr = [];

            //Find sum of values by question_id and create new map
            let map = a.reduce((a, b) =>
                a.set(b.question_id, (a.get(b.question_id) || 0) + Number(b.value)), new Map);

            //Convert from Map to Object
            let obj = this.toObject(map);

            //Create an array for each question, calculate the average of value and "reassign" question_id
            for (let [key, value] of Object.entries(obj)) {
                avgArr[key] = {
                    "question_id": key,
                    "value": (Math.round((value / (list.data.length / 4)) * 10) / 10)
                };

                //Push all arrays to array
                avg.push(avgArr[key]);
            }
            this.averageList = this.toObject(avg);
            console.log(this.averageList);
        },

        toObject(map) {
            let obj = Object.create(null);

            for (let [key, value] of map.entries()) {
                obj[key] = value;
            }
            return obj;
        },

    },
    computed: {
        subArray() {
            return this.questionList.slice(0, 3)
        }
    },
    beforeMount() {
        //this.getData();

    },
    mounted() {
        this.getQuestions();
        this.getReplies();
        this.averageMethod();
    },

}
</script>

<style scoped lang="scss">

.cardlist-container {
    width: 100%;

    display: flex;
    flex-direction: column;

    background-color: white;
    box-shadow: 0 0 15px #0000001F;
    font-family: system-ui;


    .cardlist-header {
        display: flex;
        height: 15%;
        gap: 10px;
        padding: 20px 20px 0 20px;

        > img {
            height: 50px;
            width: 50px;
        }
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

    .feedback-container {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        height: 100%;

    }

    .feedback-list {
        display: flex;
        flex-direction: column;
        width: 100%;
        min-width: fit-content;

    }

    .feedback {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        width: 100%;

    }

    .question {
        height: 33%;
        min-width: fit-content;
        padding: 20px;
        border-top: #F7F7F7 solid 2px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;

    }

    .averageList {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        border: #c7c6c6 1px solid;
        margin-left: 5px;
        margin-right: 5px;
        width: 5%;

    }
}

</style>
