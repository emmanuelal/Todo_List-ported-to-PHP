 function fadeIn(len) {
                obj = document.getElementById(len);
                obj.style.display = '';
                var op = 0; 
                var timer = setInterval(function () {
                    if (op >= 1 || op >= 1.0){
                        console.log('done', op)
                        clearInterval(timer);
                    }
                    obj.style.opacity = op.toFixed(1);
                    op += 0.1;
                    console.log(obj.style.opacity);
                }, len);
                return this;
            }
 function fadeOut(len) {
                var obj = document.getElementById(len);
                var op = 1; 
                var timer = setInterval(function () {
                    if (op <= 0){
                        clearInterval(timer);
                        console.log('done', op)
                        obj.style.display = 'none';
                    }
                    obj.style.opacity = op.toFixed(1);
                    op -= 0.1;
                    console.log(obj.style.opacity)
                }, len);
                return this;
            }