<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery contextMenu (2.x)</title>


    <link href="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js" type="text/javascript"></script>

    <script src="https://swisnl.github.io/jQuery-contextMenu/js/main.js" type="text/javascript"></script>


</head>

<body class="wy-body-for-nav">

    <div class="wy-grid-for-nav">

        <section data-toggle="wy-nav-shift" class="wy-nav-content-wrap">
            <div class="wy-nav-content">
                <div class="rst-content">
                    <div role="main" class="document">
                        <p><span class="context-menu-one btn btn-neutral">right click me</span></p>
                        <script type="text/javascript" class="showcase">
                            $(function() {
                                $.contextMenu({
                                    selector: '.context-menu-one',
                                    callback: function(key, options) {
                                        var m = "clicked: " + key;
                                        window.console && console.log(m) || alert(m);
                                    },
                                    items: {
                                        "edit": {
                                            name: "Edit",
                                            icon: "edit"
                                        },
                                        "cut": {
                                            name: "Cut",
                                            icon: "cut"
                                        },
                                        copy: {
                                            name: "Copy",
                                            icon: "copy"
                                        },
                                        "paste": {
                                            name: "Paste",
                                            icon: "paste"
                                        },
                                        "delete": {
                                            name: "Delete",
                                            icon: "delete"
                                        },
                                        "sep1": "---------",
                                        "quit": {
                                            name: "Quit",
                                            icon: function() {
                                                return 'context-menu-icon context-menu-icon-quit';
                                            }
                                        }
                                    }
                                });

                                $('.context-menu-one').on('click', function(e) {
                                    console.log('clicked', this);
                                })
                            });
                        </script>
                    </div>
                </div>
            </div>

        </section>

    </div>
    <script>
        $(function() {
            hljs.configure({
                tabReplace: '    ', // 4 spaces
            });
            hljs.initHighlightingOnLoad();
        });
    </script>

</body>

</html>