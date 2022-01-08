<form id="uploadForm" action="upload.php" method="post">
    <label>Upload Image File:</label><br />
    <input name="file" type="file" class="inputFile" id="files" />
    <img id="image" />
    <input type="submit" value="Submit" class="btnSubmit" />
</form>

<script src="/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        document.getElementById('files').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }

        $("#uploadForm").on('submit', (function(e) {
            console.log("SUBMIT");
            e.preventDefault();
            $.ajax({
                url: "/upload",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);

                },
                error: function(err) {
                    console.log(err.responseJSON, "ERROR");
                }
            });
        }));
    });
</script>