<script>
export default {
  required: value => !!value || "Campo obrigatório.",
  requiredObject: function (value) {
    if(Object.keys(value).length == 0) {
      return "Campo obrigatório";
    }
    return true;
  },
  matchPasswords: function (password, confirmationPassword) {
    if (password != confirmationPassword) {
      return "Senhas diferentes."
    }
    return true;
  },
  requiredIf: function (dependente, valor) {
    if (dependente) {
      if (valor) {
        return true;
      }
      return "Campo Obrigatório";
    }
    return true;
  },
  requiredAndNotNull: function (value) {
    if (value && (value.trim()).length > 0) {
      return true;
    }
    return "Campo Obrigatório!";
  },
  requiredList: function (list, message) {
    if (list && list.length > 0) {
      return true;
    }
    return message;
  }
};
</script>