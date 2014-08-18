<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset("bootstrap/css/bootstrap.css") }}" 
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset("bootstrap/css/bootstrap-theme.css") }}"
        />
        <title>Laravel 4 Chat</title>
    </head>
    <body>
        <script type="text/x-handlebars">
            @{{outlet}}
        </script>
        <script type="text/x-handlebars" data-template-name="index">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Laravel 4 Chat</h1>
                        <table class="table table-striped">
                            @{{#each message in model}}
                                <tr>
                                    <td @{{bind-attr class="message.user_id_class"}}>
                                        @{{message.user_name}}
                                    </td>
                                    <td>
                                        @{{message.message}}
                                    </td>
                                </tr>
                            @{{/each}}
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            @{{input type="text" value=command class="form-control"}}
                            <span class="input-group-btn">
                                <button class="btn btn-default" @{{action "send"}}>Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </script>
        <script
            type="text/javascript"
            src="{{ asset("starter-kit/js/libs/jquery-1.10.2.js") }}"
        ></script>
        <script
            type="text/javascript"
            src="{{ asset("starter-kit/js/libs/handlebars-1.1.2.js") }}"
        ></script>
        <script
            type="text/javascript"
            src="{{ asset("starter-kit/js/libs/ember-1.6.1.js") }}"
        ></script>
        <script
            type="text/javascript"
            src="{{ asset("starter-kit/js/libs/ember-data.js") }}"
        ></script>
        <script
            type="text/javascript"
            src="{{ asset("bootstrap/js/bootstrap.min.js") }}"
        ></script>
        <script
            type="text/javascript"
            src="{{ asset("js/shared.js") }}"
        ></script>
    </body>
</html>