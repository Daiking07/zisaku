jQuery(function () {


    $("#img_btn").on('click', function () {
        $("input[name='image']").on('click', function (e) {
            e.stopPropagation();
        });
        $("input[name='image']").click();
        $("input[name='image']").on('change', function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });


// chat----------------------------

    $('#comment-send-btn').on('click', function () {

        let Comment = $('#comment-input').val(); //commentを取得
        let BlogId = $('#blog_id').val();

        $('#comment-input').val(''); //もともとある要素を空にする

        if (!Comment) {
            return false;
        } //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない

        $.ajax({
            type: 'GET',
            url: "result/ajax/" + BlogId + '/' + Comment, //後述するweb.phpのURLと同じ形にする
            data: {
                'blog_id': BlogId,
                'comment': Comment, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
            },
            dataType: 'json', //json形式で受け取る

        }).done(function (data) {

            let html = '';
            $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                //ここの記述はリファクタ可能
                let id = value.id;
                let comment = value.comment;
                let blog_id = value.blog_id;
                let created_at = value.created_at;
                // １ユーザー情報のビューテンプレートを作成
                html = `
                        
                            <tr class="comment-visible">
                                <div id="comment-body"></div>
                                <th scope="row"></th>
                                <td>
                                    <li>${data.comment}</li>
                                </td>
                                <td>${data.created_at}</td>
                                <td>
                                    <button type="submit" id="${data.id}" class="btn btn-danger comment-delete index">削除</button>
                                </td>
                            </tr>
                        
                                `
            })

            $('#www').append(html); //できあがったテンプレートをビューに追加

        }).fail(function () {
            //ajax通信がエラーのときの処理
            console.log('どんまい！');
        })
    });
    
// -------------------------------------

$('#search-btn').on('click', function () {
    $('.user-table tbody').empty(); //もともとある要素を空にする
    $('.search-null').remove(); //検索結果が0のときのテキストを消す
    let Old = $('#xxx #old');

    let userName = $('#search_name').val(); //検索ワードを取得

    if (!userName) {
        return false;
    } //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない

    $.ajax({
        type: 'GET',
        url: '/user/index/' + userName, //後述するweb.phpのURLと同じ形にする
        data: {
            'search_name': userName, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        },
        dataType: 'json', //json形式で受け取る


    }).done(function (data) {
        let html = '';
        $.each(data, function (index, value) { //dataの中身からvalueを取り出す
            //ここの記述はリファクタ可能
            let id = value.id;
            let name = value.name;
            let gender = value.gender;
            if (gender == '男') { var sex = 'くん' } else { var sex = 'ちゃん' }
            console.log(gender);
            // １ユーザー情報のビューテンプレートを作成
            html = `
                            <tr id="old" class="h5">
                                <td>${name+sex}</td>
                                <td>${gender}の子</td>
                                <td><a class="text-body btn btn-outline-warning" href="/blog/${id}">日記</a></td>
                            </tr>
                                `
            $('#xxx').append(html); //できあがったテンプレートをビューに追加
        })
        Old.remove();

        // 検索結果がなかったときの処理
        if (data.length === 0) {
            $('#text').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
        }

    }).fail(function () {
        //ajax通信がエラーのときの処理
        console.log('どんまい！');
    })
})
});
