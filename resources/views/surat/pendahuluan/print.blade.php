<html>
<title>
  <style>
    .position{
        position: fixed;
        margin: 0;
        padding: 0;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        overflow: hidden;
        z-index: 9999999;
    }
  </style>
</title>

<body>
  <iframe src="{{ url('pendahuluan/' . $data->files->file) }}" class="position"
    scrolling="auto"></iframe>
</body>

</html>
