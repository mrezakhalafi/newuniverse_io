<!DOCTYPE html>
<html>

<head></head>

<body>
  <form id="myform">
    <!-- <input name="foo.bar" value="parent" />
    <input name="foo.biz" value="parent" />
    <input name="foo.cat.bar" value="child2a" />
    <input name="foo.cat.bar" value="child2b" />
    <input name="foo.cat.biz.dog.bar" value="child3" /> -->
    <input name="p-1" value="mal A" />
    <input name="p-1.c-1" value="toko A" />
    <input name="p-1.c-1.c-1" value="barang A" />
    <input name="p-2" value="mal B" />
    <input name="p-2.c-1" value="toko B" />
  </form>
  <input id='btnSerialize' value='Serialize' type='button' onclick='serialize()' />
  <div id='result'></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    function serialize() {
      var elements = document.querySelectorAll('#myform input');
      var data = {};
      for (var i = 0; i < elements.length; i++) {
        var el = elements[i];
        var val = el.value;
        if (!val) val = "";
        var fullName = el.getAttribute("name");
        if (!fullName) continue;
        var fullNameParts = fullName.split('.');
        var prefix = '';
        var stack = data;
        for (var k = 0; k < fullNameParts.length; k++) {
          prefix = fullNameParts[k];
          if (!stack[prefix]) {
            stack[prefix] = {};
          }
          stack = stack[prefix];
        }
        prefix = fullNameParts[fullNameParts.length - 1];
        if (stack[prefix]) {

          var newVal = stack[prefix] + ',' + val;
          stack[prefix] += newVal;
        } else {
          stack[prefix] = val;
        }
      }
      console.log(data);

    }

    let bla = [
      {
        parent: "mal A" ,
        
      } 
    ];
  </script>

</body>


</html>