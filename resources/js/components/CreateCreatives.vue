<template>
<div>
<button
  class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
  type="button" onclick="toggleModal('modal-example-regular')">
  Open regular modal
</button>
<!-- Modal -->
<div
  class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
  id="modal-example-regular">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200 rounded-t">
        <h3 class="text-3xl font-semibold">
          Modal Title
        </h3>
        <button
          class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
          onclick="toggleModal('modal-example-regular')">
          <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
            <i class="fas fa-times"></i>
          </span>
        </button>
      </div>
      <!--body-->
      <div class="relative p-6 flex-auto">
        <p class="my-4 text-gray-500 text-lg leading-relaxed">
          I always felt like I could do anything. That’s the main
          thing people are controlled by! Thoughts- their perception
          of themselves! They're slowed down by their perception of
          themselves. If you're taught you can’t do anything, you
          won’t do anything. I was taught I could do everything.
        </p>
      </div>
    </div>
  </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-example-regular-backdrop"></div>
</div>
</template>
<script>
    export default {
        data() {
            return {
            errors: [],
            submitting: 0,
            creatives:[{file:""}]
            }
        },

          methods: {

            onFileSelect(event)
            {
            // `files` is always an array because the file input may be in multiple mode
             document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");

            },
        /*     handleSubmitRequest()
            {
                this.submitting = 1;
                this.errors = [];
                    axios.post(this.url, {
                        kitchen_unit: this.kitchenUnit,
                        authorizer: this.authorizer,
                        request_items: this.inputList,
                        bank_details: this.bankDetail,
                        total_amount_requested: this.totalAmountRequest(),
                        _action: 'submit_request',
                    })

                .then(response => {
                    if(response.data.status){
                     this.$swal('Done!',
                                response.data.msg,
                                'success')
                                .then((result) => {
                                    if (result.isConfirmed) {
                                    location.href="/dashboard/fb/ktchen/requests"
                                    }
                                })
                    }else {
                            this.submitting = 0;
                            this.errors = response.data.error;
                    }
                }).catch(error => {
                   this.submitting = 0;
                if(error.response.status == 419 ||error.response.status == 401 ){
                    this.submitting = 0;
                    $('#loginForm').modal({backdrop: 'static', keyboard: false})
                   $('#loginForm').modal('show');

                }
            });

            }, */
            handleAddClick(){
                this.creatives.push({});

            },
            /* handleRemoveClick(index){
                delete this.inputList[index];
                this.inputList.splice(index, 1);
            },
            totalAmountRequest() {
                var total = _.reduce(this.inputList, function (sum, item) {
                    return sum + (item.qty * item.unitPrice);
                }, 0);
                return total;
            }, */
          }
    }
</script>
