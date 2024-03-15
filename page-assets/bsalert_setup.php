<script>
const alert_types = {
    error: "alert-danger",
    success: "alert-success"
};

function create_alert(type, msg) {
    if(!(type in alert_types)) {
        throw new Error("type not correct");
    } else {
        type = alert_types[type];
    }
    let alert_string = `
    <div class="alert ` + type + ` alert-dismissible fade show">`
    + msg + `<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    `;
    $('.container-fluid').prepend(alert_string);
}
</script>