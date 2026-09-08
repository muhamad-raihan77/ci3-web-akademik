<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <?php echo $title; ?>
    </h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- CONFIG AREA -->
            <div class="row mb-3">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="apiKey" class="font-weight-bold"><i class="fas fa-key"></i> OpenRouter API Key</label>
                        <div class="input-group">
                            <input type="password" id="apiKey" class="form-control" placeholder="Masukkan sk-or-v1-... atau biarkan kosong jika sudah di-hardcode di controller">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleApiKey">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">API Key disimpan di browser lokal (Local Storage) Anda.</small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="modelSelect" class="font-weight-bold"><i class="fas fa-robot"></i> Model AI</label>
                        <select id="modelSelect" class="form-control">
                            <option value="meta-llama/llama-3.1-8b-instruct:free">meta-llama/llama-3.1-8b-instruct:free (Rekomendasi Gratis)</option>
                            <option value="google/gemini-2.5-flash:free">google/gemini-2.5-flash:free (Gratis)</option>
                            <option value="openai/gpt-4o-mini">openai/gpt-4o-mini</option>
                            <option value="deepseek/deepseek-chat">deepseek/deepseek-chat</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <!-- CHAT AREA -->
            <div id="chat-box" style="height: 350px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; background: #f8f9fc; border-radius: 5px;">
            </div>
            
            <div class="input-group mt-3">
                <input type="text" id="message" class="form-control" placeholder="Tulis pesan...">
                <div class="input-group-append">
                    <button class="btn btn-primary" id="sendBtn">
                        Kirim
                    </button>
                </div>
            </div>
            
            <!-- DEBUG AREA -->
            <div class="mt-4">
                <h5>Debug Response</h5>
                <pre id="debug-box" style="background: black; color: lime; padding: 15px; height: 300px; overflow: auto; border-radius: 5px;">Menunggu response...</pre>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Load saved config from local storage
$(document).ready(function() {
    if (localStorage.getItem('openrouter_api_key')) {
        $('#apiKey').val(localStorage.getItem('openrouter_api_key'));
    }
    if (localStorage.getItem('openrouter_model')) {
        $('#modelSelect').val(localStorage.getItem('openrouter_model'));
    }
});

// Save config when changed
$('#apiKey').on('input', function() {
    localStorage.setItem('openrouter_api_key', $(this).val());
});
$('#modelSelect').on('change', function() {
    localStorage.setItem('openrouter_model', $(this).val());
});

// Toggle API Key visibility
$('#toggleApiKey').click(function() {
    let apiKeyInput = $('#apiKey');
    let eyeIcon = $('#eyeIcon');
    if (apiKeyInput.attr('type') === 'password') {
        apiKeyInput.attr('type', 'text');
        eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        apiKeyInput.attr('type', 'password');
        eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
});

function sendMessage()
{
    let message = $('#message').val();
    if(message.trim() == ''){
        return;
    }
    
    let apiKey = $('#apiKey').val();
    let selectedModel = $('#modelSelect').val();
    
    // Append user message to chat box
    $('#chat-box').append(`
        <div style="margin-bottom: 15px; text-align: right;">
            <div style="background: #4e73df; color: white; padding: 10px; border-radius: 10px; display: inline-block; max-width: 80%; text-align: left;">
                ${message}
            </div>
        </div>
    `);
    
    $('#message').val('');
    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

    $.ajax({
        url: "<?= base_url('chatbot/send'); ?>",
        type: "POST",
        dataType: "json",
        data: { 
            message: message,
            api_key: apiKey,
            model: selectedModel
        },
        success: function(response)
        {
            $('#debug-box').text(JSON.stringify(response, null, 4));
            console.log(response);
            
            if(response.debug){
                let debug = response.debug;
                if(
                    debug.decoded_response &&
                    debug.decoded_response.choices &&
                    debug.decoded_response.choices.length > 0 &&
                    debug.decoded_response.choices[0].message
                ){
                    let reply = debug.decoded_response.choices[0].message.content;
                    // Replace markdown-like newlines or format nicely
                    let formattedReply = reply.replace(/\n/g, '<br>');
                    $('#chat-box').append(`
                        <div style="margin-bottom: 15px; text-align: left;">
                            <div style="background: #eaeaea; color: black; padding: 10px; border-radius: 10px; display: inline-block; max-width: 80%;">
                                ${formattedReply}
                            </div>
                        </div>
                    `);
                } else {
                    let errorMsg = 'AI tidak memberikan response';
                    if (debug.decoded_response && debug.decoded_response.error) {
                        errorMsg += ': ' + debug.decoded_response.error.message;
                    } else if (debug.raw_response) {
                        try {
                            let parsedRaw = JSON.parse(debug.raw_response);
                            if (parsedRaw.error) {
                                errorMsg += ': ' + parsedRaw.error.message;
                            }
                        } catch(e) {}
                    }
                    $('#chat-box').append(`
                        <div style="margin-bottom: 15px; text-align: left;">
                            <div style="background: #ffcccc; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 10px; display: inline-block;">
                                <strong>Error:</strong> ${errorMsg}
                            </div>
                        </div>
                    `);
                }
            } else {
                $('#chat-box').append(`
                    <div style="margin-bottom: 15px; text-align: left;">
                        <div style="background: #ffcccc; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 10px; display: inline-block;">
                            Format response tidak sesuai
                        </div>
                    </div>
                `);
            }
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        },
        error: function(xhr, status, error)
        {
            console.log(xhr.responseText);
            $('#debug-box').text(xhr.responseText);
            $('#chat-box').append(`
                <div style="margin-bottom: 15px; text-align: left;">
                    <div style="background: #ffcccc; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 10px; display: inline-block;">
                        AJAX ERROR (Status: ${status})
                    </div>
                </div>
            `);
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        }
    });
}

$(document).ready(function() {
    $('#sendBtn').click(function(){ 
        sendMessage();
    });
    
    $('#message').keypress(function(e){
        if(e.which == 13){
            sendMessage();
        }
    });
});
</script>
