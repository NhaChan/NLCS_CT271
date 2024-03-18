<?php include '../../partials/heading.php' ?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header bg-dark text-light">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Giỏ hàng
            <a href="index.php" class="btn btn-outline-info btn-sm pull-right float-end">Tiếp tục mua hàng</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-sm-3">Sản phẩm</th>
                        <th class="col-sm-4">Tên sản phẩm</th>
                        <th class="col-sm-1">Số lượng</th>
                        <th class="col-sm-2">Giá</th>
                        <th class="col-sm-2"></th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
                <tbody>
                    <tr>

                        <td></td>
                        <td class="d-flex justify-content-end pb-4 lead" colspan="4">Tổng: <span class="mx-2" id="amount"></span></td>
                        <td></td>
                        <td></td>
                        <td><a href="#" id="order"><button class="btn btn-outline-warning" id="check_out">Đặt hàng</button></a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../partials/footer.php' ?>

<script>
    var table_tag = document.getElementById('tbody');
    const name = `<?= $_SESSION['id']; ?>`;
    const pd = JSON.parse(localStorage.getItem(name));
    var total = 0;

    const delFunc = (pid, price) => {
        // console.log(pid, price);
        pd.forEach((e, i) => {
            if (e.pid == pid && e.price == price) {
                let spliced = pd.splice(i, 1);
                localStorage.setItem(name, JSON.stringify(pd));
                document.location.reload();
            }
        })
    }
    //display items
    if (pd && pd.length > 0) {
        pd.forEach(e => {
            total += e.price * e.quanlity;
            const tr = document.createElement('tr');
            const td1 = document.createElement('td');
            const td2 = document.createElement('td');
            const td3 = document.createElement('td');
            const td4 = document.createElement('td');
            const td5 = document.createElement('td'); // Added for product name
            const btn = document.createElement('button');
            const img = document.createElement('img');
            const input = document.createElement('input');

            const productName = document.createTextNode(e.pname); // Assuming you have a property 'name' in your product object
            const price = document.createTextNode(e.price);
            const quanlity = document.createTextNode(e.quanlity);
            const del = document.createTextNode('Xóa');

            input.setAttribute('type', 'checkbox');
            input.setAttribute('id', `check${e.pid.trim()}/${e.price}`);
            input.setAttribute('onclick', `func(${e.pid}, '${e.img}', '${e.pname}', ${e.price}, ${e.quanlity})`)
            img.setAttribute('src', `../admin/upload/product_detail/${e.img}`);
            img.setAttribute('class', 'w-50');
            btn.setAttribute('onclick', `delFunc(${e.pid}, ${e.price})`)

            td1.append(input);
            td1.append(img);
            td2.append(productName); // Added for product name
            td3.append(quanlity);
            td4.append(price);
            btn.append(del);
            btn.setAttribute('class', 'btn btn-outline-danger');
            btn.setAttribute('id', `${e.pid}/${e.price}`);
            td5.append(btn);

            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            tr.append(td5); // Added for the new column

            table_tag.append(tr);
        })

    } else {
        const div = document.createElement('div');
        div.setAttribute('class', 'text-center');
        const text = document.createTextNode('Chưa có sản phẩm nào trong giỏ hàng');
        div.append(text);
        table_tag.append(div);
    }

    //total price
    const t = document.getElementById('amount');
    const text = document.createTextNode(total);
    t.append(text);

    //select items
    const items = [];
    const func = (id, img, pname, price, quanlity) => {
        const checkbox = document.getElementById(`check${id}/${price}`);
        const item = {
            "pid": id,
            "img": img,
            "pname": pname,
            "price": price,
            "quanlity": quanlity
        }

        if (checkbox.checked) {
            items.push(item);
        } 

        localStorage.setItem(`order${name}`, JSON.stringify(items));
        document.getElementById('order').setAttribute('href', 'order.php');
    }
    console.log(items);
    
</script>