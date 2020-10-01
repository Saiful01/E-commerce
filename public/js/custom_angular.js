var app = angular.module('myApp', []);


app.controller('myCtrl', function ($scope, $http) {


    $scope.cartActive = false;
    $scope.cartCount = 0;
    $scope.totalPriceCountAll = 0;
    $scope.detail_page_quantity = 1;
    $scope.shipping_cost = 20;
    $scope.zone=[1];
    console.log($scope.zone);

    $scope.productCartInfo = {
        "id": '',
        "name": '',
        "price": '',
        "qnt": '',
    };
    $scope.qnt = 1;
    $scope.itemList = [];
    $scope.addToCart = function (product_id, product_name, image, selling_price) {
        $scope.cartActive = true;
        let flag = false;
        let tempProduct = [];
        let cartProductList = localStorage.getItem('cartProductList');
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);

            if (cartProductList.length <= 0) {
                tempProduct = {
                    "id": product_id,
                    "name": product_name,
                    "price": selling_price,
                    "image": image,
                    "qnt": $scope.qnt
                };
            } else {
                for (var cartProduct of cartProductList) {

                    if (cartProduct.id === product_id) {
                        cartProduct.qnt += 1;

                        flag = true;
                        break;
                    } else {

                        tempProduct = {
                            "id": product_id,
                            "name": product_name,
                            "price": selling_price,
                            "image": image,
                            "qnt": $scope.qnt
                        };

                    }
                    /*console.log("lol");*/
                }
            }

        } else {
            cartProductList = [];
            tempProduct = {
                "id": product_id,
                "name": product_name,
                "price": selling_price,
                "image": image,
                "qnt": $scope.qnt
            };
        }
        if (!flag) {
            cartProductList.push(tempProduct);
            //messageSuccess("Successfully product added", "Success")
        }
        /*console.log("added");*/
        localStorage.setItem('cartProductList', JSON.stringify(cartProductList));

        $scope.getTotalPrice();
        $scope.getList();
    };

    //Details cart
    $scope.addToCartFromDetailsPage = function (product_id, product_name, image, selling_price) {

        $scope.cartActive = true;
        let flag = false;
        let tempProduct = [];
        let cartProductList = localStorage.getItem('cartProductList');
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);

            if (cartProductList.length <= 0) {
                tempProduct = {
                    "id": product_id,
                    "name": product_name,
                    "price": selling_price,
                    "image": image,
                    "qnt": $scope.detail_page_quantity
                };
            } else {
                for (var cartProduct of cartProductList) {

                    if (cartProduct.id === product_id) {
                        cartProduct.qnt += $scope.detail_page_quantity;
                        flag = true;
                        break;
                    } else {

                        tempProduct = {
                            "id": product_id,
                            "name": product_name,
                            "price": selling_price,
                            "image": image,
                            "qnt": $scope.qnt
                        };

                    }
                    /*console.log("lol");*/
                }
            }

        } else {
            cartProductList = [];
            tempProduct = {
                "id": product_id,
                "name": product_name,
                "price": selling_price,
                "image": image,
                "qnt": $scope.qnt
            };
        }
        if (!flag) {
            /*console.log("Nope");*/
            cartProductList.push(tempProduct);
        }
        /*console.log("added");*/
        localStorage.setItem('cartProductList', JSON.stringify(cartProductList));

        $scope.getTotalPrice();
        $scope.getList();
    };


    $scope.getProductCartInfo = function () {

        let cartProductList = localStorage.getItem('cartProductList');
        let totalCount = 0;
        let totalPrice = 0;
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            totalCount = cartProductList.length;

            for (var cartProduct of cartProductList) {
                totalPrice = totalPrice + parseInt(cartProduct.price);
            }

        }

        return {'totalCount': totalCount, 'totalPrice': totalPrice, 'cartProductList': cartProductList};
    };

    $scope.getTotalPrice = function () {

        let cartProductList = localStorage.getItem('cartProductList');
        let totalPrice = 0;
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            for (var cartProduct of cartProductList) {
                totalPrice = totalPrice + parseInt(cartProduct.price) * parseInt(cartProduct.qnt);
            }
        }
        /*console.log(totalPrice + " llll");*/
        $scope.totalPriceCountAll = totalPrice;
    };

    $scope.cartItemPList = [];
    $scope.getList = function () {

        let cartProductList = localStorage.getItem('cartProductList');
        let totalCount = 0;
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            $scope.cartItemPList = cartProductList;
            $scope.cartActive = true;
        }
    };

    $scope.$watch('cartItemPList', function () {

    });

    $scope.showPopover = function () {
        $scope.popoverIsVisible = true;
    };

    $scope.hidePopover = function () {
        $scope.popoverIsVisible = false;
    };

    $scope.removeItem = function (item) {
        let cartProductList = localStorage.getItem('cartProductList');
        if (cartProductList != null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);

            for (let i = 0; i < cartProductList.length; i++) {
                if (cartProductList[i].id === item.id) {
                    cartProductList.splice(i, 1);
                    break;
                }
            }

            /*console.log("cartProductList", cartProductList);*/
            localStorage.setItem('cartProductList', JSON.stringify(cartProductList));
        }

        $scope.getTotalPrice();
        $scope.getList();
    };

    $scope.itemAdd = function (item) {

        let cartProductList = localStorage.getItem('cartProductList');
        if (cartProductList != null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);

            for (let i = 0; i < cartProductList.length; i++) {
                if (cartProductList[i].id === item.id) {
                    cartProductList[i].qnt += 1;
                    break;
                }
            }
            /*console.log("cartProductList", cartProductList);*/
            localStorage.setItem('cartProductList', JSON.stringify(cartProductList));
        }
        $scope.getTotalPrice();
        $scope.getList();
        /*console.log("lol");*/

    };
    $scope.itemMinus = function (item) {

        let cartProductList = localStorage.getItem('cartProductList');
        if (cartProductList != null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);

            for (let i = 0; i < cartProductList.length; i++) {
                if (cartProductList[i].id === item.id) {

                    if (cartProductList[i].qnt <= 1) {
                        messageError("Cant remove items", 'error');
                        break;
                    } else {
                        cartProductList[i].qnt -= 1;
                    }
                    break;
                }
            }
            /*console.log("cartProductList", cartProductList);*/
            localStorage.setItem('cartProductList', JSON.stringify(cartProductList));
        }
        $scope.getTotalPrice();
        $scope.getList();

    };

    function messageError(cantRemoveItems, error) {
        toastr.info(cantRemoveItems, error);
    }

    function messageSuccess(message, success) {
        toastr.success(message, success);
    }


    //Details page
    $scope.addQuantity = function () {
        if ($scope.detail_page_quantity > 1) {
            $scope.detail_page_quantity = $scope.detail_page_quantity - 1;
        } else {
            messageError("You must select more than 1 Quantity", "Error")
        }

    };
    $scope.removeQuantity = function () {
        $scope.detail_page_quantity = $scope.detail_page_quantity + 1;
    };


    $scope.getList();
    $scope.getTotalPrice();


    //Save Product

    $scope.saveProducts = function (items) {

        var flag = false;
        if ($scope.customer_name == null || $scope.customer_name === "") {
            flag = true;
        }
        if ($scope.customer_phone == null || $scope.customer_phone === "") {
            flag = true;
        }
        /* if ($scope.customer_email == null || $scope.customer_email === "") {
             flag = true;
         }*/
        if ($scope.customer_address1 == null || $scope.customer_address1 === "") {
            flag = true;
        }

        if ($scope.cartItemPList.length <= 0) {
            messageError("Add some item first", 'Cart is Empty');
            return;
        }

        if (flag) {
            messageError("You must fill all the input field", 'Error');
            /*console.log("Error");*/
        } else {
            $http.post('/customer/order/store', {
                items: items,
                customer_name: $scope.customer_name,
                customer_phone: $scope.customer_phone,
                customer_email: $scope.customer_email,
                customer_address1: $scope.customer_address1,
                customer_city: $scope.customer_city,
                customer_country: $scope.customer_country,
                total_price: $scope.totalPriceCountAll,
                shipping_cost: $scope.shipping_cost,

            }).then(function success(e) {

                /*console.log(e);*/
                if (e.data.status == "success") {
                    /*console.log(e.data.message);*/
                    localStorage.removeItem('cartProductList');
                    $scope.cartItemPList = [];
                    $scope.totalPriceCountAll = 0;
                    $scope.getList();

                    $scope.customer_name = null;
                    $scope.customer_phone = null;
                    $scope.customer_email = null;
                    $scope.customer_address1 = null;
                    $scope.customer_city = null;
                    $scope.customer_country = null;

                    toastr.success("আপনার অর্ডারটি গ্রহণ করা হয়েছে ", "ধন্যবাদ");
                } else {
                    /*console.log(e.data.message);*/
                    toastr.info("There was problem. Try Later", "Success");
                }

            }, function error(error) {

                messageError(error.statusText, 'Error');
            });
        }

    }


    $scope.getCustomerProfile = function (customer_id) {
        $http.post('/customer/profile', {
            customer_id: customer_id
        }).then(function success(e) {

            if (e.data.status == "success") {

                $scope.customer_name = e.data.customer.customer_name;
                $scope.customer_phone = e.data.customer.customer_phone;
                $scope.customer_city = e.data.customer.customer_city;
                $scope.customer_email = e.data.customer.customer_email;
                $scope.customer_address1 = e.data.customer.customer_address1;
                //console.log(e.data.customer);
            } else {
                //console.log(e.data.message);
            }

        });
    };


    $scope.zoneChange = function (zone_id) {

        console.log(zone_id);
        if(zone_id==2){
            $scope.shipping_cost=100;
        }else{
            $scope.shipping_cost=20;
        }


    };
});
