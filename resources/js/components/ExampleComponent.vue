
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
            
                 <div class="card-header">{{title}}
                    <span class="badge badge-success">
                        {{category_name}}
                    </span>
                 </div> 


                  <div class="card-body text-center drill-body">
                    <button class="btn btn-primary" @click="doDrill" v-if="!isStarted">
                        START
                    </button>
                    <p v-if="isCountDown" style="font-size: 100px;">{{countDownNum}}</p>
                    <template v-if="isStarted && !isCountDown && !isEnd">
                      <p>{{timeNum}}</p>
                      <p class="problem-text">
                        <span v-for="(word, index) in problemWords" :class="{'text-primary': index < currentWordNum}">{{word}}</span>
                      </p>
                    </template>
                    <template v-if="isEnd">
                        <p>あなたのスコア</p>
                        <p>{{typingScore}}</p>
                    </template>
                  </div>

                </div>
            </div>
        </div>
    </div>
</template>






<script>
  import keyCodeMap from '../master/keymap'   //照らし合せのためキーコードマップを作成
  //コンポーネント側ではなんでもかんでも値がきてしまうと困るのでどの値は許可するのか定義しておく
  console.log('ExampleComponent読み込めています')
  export default{
      props: ['title', 'drill', 'category_name'], //親からこのコンポーネントに値を流し込む propsで受け取る値とは
      data: function(){
          return{
              countDownNum: 3, //カウントダウン用 
              timeNum: 30, //タイマー
              missNum: 0,　//ミス数
              wpm: 0, //WPM　タイプの速さ　タイピングスコアによって変えていく
              isStarted: false,
              isEnd: false,
              isCountDown: false,
              currentWordNum: 0, //現在回答中の文字数目
              currentProblemNum: 0, //現在の問題番号　この番号が、this.drillのDBのカラムの中にあるproblrm番号と対応している
          }
      },
      computed: { //リアルタイムで変更していくので監視するデータ　自動で監視しているので次の問題へ行く
        　problemWords: function(){//問題文自体
            return Array.from(this.drill['problem' + this.currentProblemNum])//this.drillの現在の問題番号　this.drillはpropsのdrill(phpの方からjsに渡してきたデータ)
            //this.drillの中身についてDBのカラムをキーに取ったデータが入っているのでproblem0 problem1という風に取り出していくことができる
          },
          problemKeyCodes: function(){  //問題の回答キーコードの配列  １文字１文字のキーコードが入っている　問題文が変わるたびに変わっていく
                if(!Array.from(this.drill['problem' + this.currentProblemNum]).length){//
                    return null
                }
                let problemKeyCodes = []//重要！！　問題の文字列から１文字１文字のキーコード配列を生成
                console.log('problemKeyCodes文字数:', Array.from(this.drill['problem' + this.currentProblemNum]).length)//その問題文の文字数
                Array.from(this.drill['problem' + this.currentProblemNum]).forEach((text) => {
                    $.each(keyCodeMap, (keyText, keyCode) => {
                        if(text == keyText){
                            problemKeyCodes.push(keyCode);
                        }
                    })
                })
                console.log(problemKeyCodes)//問題文のキーコード
                return problemKeyCodes  //配列の形にする
          },
          totalWordNum: function(){ //実際の問題の文字数 　　computedで自動監視しているため、この時点でproblemKeyCodesは可変の値
                return this.problemKeyCodes.length　　
          },
          typingScore: function(){  //あなたのスコアで使われる　　
              return (this.wpm  * 2) * (1 - this.missNum / (this.wpm * 2)) //正答率を考える
          }
      },
      methods: { //vue.jsで使える関数　監視されない
        doDrill: function(){
            console.log('doDrill: startボタンクリックされました')
            this.isStarted = true
            this.countDown()
        },
        countDown: function(){
            console.log('countDowm: ゲームが始まるまでカウントダウンします')
            //効果音があればmp3ファイルで
            //パスはコンパイルされたpublic/js/app.jsから見たパスになるので注意
            // const countSound = new Auidio(パス)
            // const startSound = new Auidio(パス
            this.isCountDown = true
            // this.soundPlay(countSound)
            let timer = window.setInterval(() => {
                this.countDownNum -= 1//カウントダウンを3.2.1
                if(this.countDownNum <=0){　//カウントダウンが0になったら次の処理に移っていく    
                    console.log('countDown: カウントダウン終わりました。isCountDownをfalseにします')
                    this.isCountDown = false //フラグをfalseに
                    // this.soundPlay(startSound) //始まったよ、というサウンドを作ること
                    window.clearInterval(timer)  //1秒ごとの処理を解除する
                    this.countTimer() //タイピング練習のカウントが始まる
                    this.showFirstProblem()　//カウントしつつも問題は表示していくこと

                    return

                }
                // カウントダウンされるごとにサウンドをつける
                // countSound.currentTime = 0
                // countSound.play()
            }, 1000);
        },
        showFirstProblem: function(){ //問題を提示
            console.log('showFrstProblem: 練習問題を提示させます')
            console.log('showFirstProblem問題内容:', this.problemWords)
            console.log('showFirstProblemその問題のキーコード:', this.problemKeyCodes)
            //効果音
            // const okSound = new Audio()
            // const ngSound = new Audio()
            // const nextSound = new Audio()

            //キーが打たれる度、入力イベントじに入力キーと回答キーをチェック
            $(window).on('keypress', e => {  
                console.log('キー入力がありました')
                console.log('何のキーがクリックされたか',e.which) //whichの中にキー入力された番号が出てくる
                if(e.which === this.problemKeyCodes[this.currentWordNum]){ //入力されたキーコードと問題のキーコードがあっているかどうか判別
                    //this.problemKeyCodes(computedの中)
                console.log('マッチしてます！')
                // this.soundPlay(okSound)
                ++this.currentWordNum//打ってる途中で問題に合致している場合、現在何文字目がをインクリメントすること
                ++this.wpm　//
                console.log('現在回答の文字数目: ' + this.currentWordNum)

                //全文字正解が終わったら、次の問題へ
                if(this.totalWordNum === this.currentWordNum){ //正解している なおかつ今の文字数が
                    console.log('全て正解！次の問題へ')
                    ++this.currentProblemNum//ここがインクリメントされることでcomputedでの監視が行われる
                    this.currentWordNum = 0
                    // this.soundPlay(nextSound)
                }
              }else{//入力された文字があっていない　不正解の場合
                console.log('不正解です')
                // this.soundPlay(ngSound)
                ++this.missNum //ミス数をインクリメント
                console.log('ミスポイント', this.missNum)
              }
            })
        },
        countTimer: function(){ //30秒からカウントダウンする
            console.log('countTimer: countTimerが呼ばれました')
            // const endSound = new Audio(パス)
            let timer = window.setInterval(() => {
                this.timeNum -= 1
                if(this.timeNum <= 0){
                    this.isEnd = true

                    window.clearInterval(timer)
                    // endSound.play()
                }
            }, 1000)
        }
          
      }
  }

// export　defaultで必要なpropsを算出することができる
//vueで使うプロパティを定義する
//動的に変わるようなプロパティはconputedで定義してあげて
//それぞれmwthodで実行させたいものを定義する
//@clickでmethodやv-ifでフラグによる表示非表示を使う
//プロパティを展開させて表示させる場合はtableとか　をv-forで展開
</script>

