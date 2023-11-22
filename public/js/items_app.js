new Vue({
    el: '#app',
    data: {
        texts: [],
    },
    methods: {
        removeInput(index) {
            this.texts.splice(index, 1);
        },
        addInput() {
            this.texts.push('');
        },
        onSubmit() {
            // ここに送信の処理を追加
        }
    }
});