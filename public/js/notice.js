// ダッシュボードをリアルタイムで更新する関数
function updateDashboard() {
    $.ajax({
        url: '/dashboard', // サーバーのエンドポイント
        type: 'GET', // GETリクエストを使用
        success: function(data) {
            // サーバーからのデータを使用してダッシュボードを更新
            $('#dashboard-content').html(data);
        },
        error: function(xhr, status, error) {
            // エラーが発生した場合の処理
            console.error(error);
        }
    });
}

// 一定の間隔でダッシュボードを更新
setInterval(updateDashboard, 5000); // 5秒ごとに更新（5000ミリ秒）
