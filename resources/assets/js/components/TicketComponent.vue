<template>
  <div>
    <div class="pmd-card pmd-card-default pmd-z-depth">
      <div class="pmd-card-title">
        <div class="row">
          <div class="col-md-6">
            <h2 class="pmd-card-title-text">eTickets</h2>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn pmd-ripple-effect btn-primary pmd-z-depth" @click="openModal()">Add Ticket</button>
          </div>
        </div>
      </div>

      <div class="pmd-card-body">
        <div class="pmd-card pmd-card-default pmd-z-depth" v-for="ticket in tickets" :key="ticket.id">
          <div class="pmd-card-title">
            <div class="row">
              <div class="col-md-9"><strong>Ticket No: {{ ticket.id }} - ({{ ticket.type }})</strong></div>
              <div class="col-md-3 text-center" :class="{ 'bg-primary': statusObject.isOpen, 'bg-info': statusObject.isProcess, }">
                <a href="#" class="edit_a" @click="editTicket(ticket)">{{ ticket.status }}</a>
              </div>
            </div>
          </div>
          <div class="pmd-card-body">
            <div class="row">
              <div class="col-md-8">{{ ticket.from }}<br />{{ ticket.email }}<br />{{ ticket.company }}</div>
              <div class="col-md-4">Order No: <a :href="`fmp://$/Change_Companies.fmp12?script=FindWebAccessOrder&param=${ticket.order_no}`">{{ ticket.order_no }}</a><br />Acct No: <a :href="`fmp://$/Change_Companies.fmp12?script=openAccount&param=${ticket.acct_no}`">{{ ticket.acct_no }}</a><br />By: {{ ticket.user.name }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="pmd-card-actions text-center">
        <button type="button" :class="[{disabled: !pagination.prev_page_url}]" class="btn pmd-btn-flat pmd-ripple-effect btn-primary" @click="fetchTickets(pagination.first_page_url)">First</button>
        <button type="button" :class="[{disabled: !pagination.prev_page_url}]" class="btn pmd-btn-flat pmd-ripple-effect btn-primary" @click="fetchTickets(pagination.prev_page_url)">Previous</button>
        <button type="button" :class="[{disabled: !pagination.next_page_url}]" class="btn pmd-btn-flat pmd-ripple-effect btn-primary" @click="fetchTickets(pagination.next_page_url)">Next</button>
        <button type="button" :class="[{disabled: !pagination.next_page_url}]" class="btn pmd-btn-flat pmd-ripple-effect btn-primary" @click="fetchTickets(pagination.last_page_url)">Last</button>
      </div>
    </div>

    <vue-modal :on-close="closeModal" name="my-modal">
          <div class="modal-header pmd-modal-bordered">
            <h2 class="pmd-card-title-text">eTicket Form</h2>
          </div>
          <form @submit.prevent="addTicket" class="form-horizontal">
            <div class="modal-body">
                <div class="form-group pmd-textfield">
                  <label for="from">From</label>
                  <input type="text" class="mat-input form-control" id="from" value="" v-model="ticket.from">
                </div>
                <div class="form-group pmd-textfield">
                  <label for="company">Company</label>
                  <input type="text" class="mat-input form-control" id="company" value="" v-model="ticket.company">
                </div>
                <div class="form-group pmd-textfield">
                  <label for="phone">Phone</label>
                  <masked-input
                    type="text"
                    name="phone"
                    class="mat-input form-control"
                    v-model="ticket.phone"
                    :mask="['(', /[1-9]/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/, ' ', /\d/, /\d/, /\d/, /\d/, /\d/]"
                    :guide="false"
                    placeholderChar="#">
                  </masked-input>
                </div>
                <div class="form-group pmd-textfield">
                  <label for="email">Email Address</label>
                  <input type="email" class="mat-input form-control" id="email" value="" v-model="ticket.email">
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group pmd-textfield">
                      <label for="order_no">Order Number</label>
                      <input type="text" class="mat-input form-control" id="order_no" value="" v-model="ticket.order_no">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group pmd-textfield">
                      <label for="acct_no">Account Number</label>
                      <input type="text" class="mat-input form-control" id="acct_no" value="" v-model="ticket.acct_no">
                    </div>
                  </div>
                </div>

                <div class="form-group pmd-textfield">
                  <label>Type</label>
                  <select class="select-simple form-control pmd-select2" id="type" v-model="ticket.type">
                    <option></option>
                    <option value="eTraining">eTraining</option>
                    <option value="Streaming">Streaming</option>
                    <option value="Other">Other</option>
                  </select>
                </div>

                <div class="form-group pmd-textfield">
                  <label class="control-label">Issue</label>
                  <textarea required class="form-control" id="message" v-model="ticket.message"></textarea>
                </div>
            </div>
            <div class="pmd-modal-action">
              <button type="submit" class="btn pmd-ripple-effect btn-primary">Save changes</button>
              <button type="button" class="btn pmd-ripple-effect btn-default" @click="closeModal()">Discard</button>
            </div>
          </form>
    </vue-modal>
  </div>
</template>

<script>
  import MaskedInput from 'vue-text-mask';
  import VueModal from "vue2-modal";
  import Toastr from 'vue-toastr';

  require('vue-toastr/src/vue-toastr.scss');

  Vue.use(Toastr);
  Vue.use(VueModal);

  export default {
    components: {
      MaskedInput,
    },

    data() {
      return {
        tickets: [],
        ticket: {
          id: '',
          to: '',
          from: '',
          company: '',
          email: '',
          type: '',
          order_no: '',
          acct_no: '',
          user_id: '',
          status: '',
          message: '',
        },
        ticket_id: '',
        pagination: {},
        edit: false,
        statusObject: {
          isOpen: true,
          isProcess: false,
          'bg-danger': false,
          'bg-success': false,
          'bg-warning': false,
        },
      }
    },

    created() {
      this.fetchTickets();

      Echo.channel('orders')
          .listen('OrderStatusUpdate', (e) => {
              alert('The trigger has fired.');
          });
    },

    computed: {
    },

    methods: {
      fetchTickets(page_url) {
        let vm = this;
        page_url = page_url || 'api/tickets'
        fetch(page_url)
          .then(res => res.json())
          .then(res => {
            this.tickets = res.data;
            vm.makePagination(res.meta, res.links);
          })
          .catch(err => {console.log(err); console.warn(xhr.responseText)});
      },
      makePagination(meta, links) {
        let pagination = {
          current_page: meta.current_page,
          last_page: meta.last_page,
          first_page_url: links.first,
          next_page_url: links.next,
          prev_page_url: links.prev,
          last_page_url: links.last
        }

        this.pagination = pagination;
      },
      addTicket() {
        //add
        if (this.edit === false) {
          this.ticket.to = '1';
          this.ticket.user_id = '2';
          this.ticket.status = 'Open';

          fetch('api/ticket', {
            method: 'post',
            body: JSON.stringify(this.ticket),
            headers: {
              'content-type': 'application/json'
            }
          })
            .then(res => res.json())
            .then(data => {
              this.ticket.from = '';
              this.ticket.company = '';
              this.ticket.phone = '';
              this.ticket.email = '';
              this.ticket.order_no = '';
              this.ticket.acct_no = '';
              this.ticket.type = '';
              this.ticket.message = '';

              this.fetchTickets();
              this.closeModal();
              this.$toastr.s("Ticket Saved!");
            })
            .catch(err => console.log(err));
        } else {
          //update
          this.ticket.to = '1';
          this.ticket.user_id = '2';
          this.ticket.status = 'Open';

          fetch('api/ticket', {
            method: 'put',
            body: JSON.stringify(this.ticket),
            headers: {
              'content-type': 'application/json'
            }
          })
            .then(res => res.json())
            .then(data => {
              this.ticket.from = '';
              this.ticket.company = '';
              this.ticket.phone = '';
              this.ticket.email = '';
              this.ticket.order_no = '';
              this.ticket.acct_no = '';
              this.ticket.type = '';
              this.ticket.message = '';

              this.fetchTickets();
              this.closeModal();
              this.$toastr.s("Ticket Updated!");
            })
            .catch(err => console.log(err));
        }
      },
      editTicket(ticket) {
        this.openModal();
        this.edit = true;
        this.ticket.id = ticket.id;
        this.ticket.ticket_id = ticket.id;
        this.ticket.from = ticket.from;
        this.ticket.company = ticket.company;
        this.ticket.phone = ticket.phone;
        this.ticket.email = ticket.email;
        this.ticket.order_no = ticket.order_no;
        this.ticket.acct_no = ticket.acct_no;
        this.ticket.type = ticket.type;
        this.ticket.message = ticket.message;
      },
      openModal() {
        this.$modals.show("my-modal");
      },
      closeModal() {
        this.edit = false;

        this.ticket.id = '';
        this.ticket.ticket_id = '';
        this.ticket.from = '';
        this.ticket.company = '';
        this.ticket.phone = '';
        this.ticket.email = '';
        this.ticket.order_no = '';
        this.ticket.acct_no = '';
        this.ticket.type = '';
        this.ticket.message = '';

        this.$modals.hide("my-modal");
      }
    }
  }
</script>
