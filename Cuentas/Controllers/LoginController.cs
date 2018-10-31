using Cuentas.Models;
using Cuentas.Models.ViewModels;
using System.Linq;
using System.Web.Mvc;

namespace Cuentas.Controllers
{
    public class LoginController : Controller
    {
        CuentasEntities BD = new CuentasEntities();
        // GET: Login
        public ActionResult Index()
        {
            return View();
        }

        public ActionResult Registrar()
        {
            return View();
        }

        [HttpPost]
        public ActionResult Validar(Usuario usr)
        {
            return Redirect("/");
        }

        [HttpPost]
        public ActionResult Registrar(VMUsuario usr)
        {
            //Consultamos los usuarios del sistema
            var Usuario = BD.Usuario;
            //Consultamos si existe un usuario con ese correo o con ese usuario
            var Existentes = Usuario.Where(a => a.UserName.Equals(usr.UserName) || a.Email.Equals(usr.Email)).Count();
            //Validamos si Existe mas de un usuario o correo 
            if (Existentes > 0)
            {
                ViewBag.Error = "Ya está registrado ese Correo o UserName";
            }
            else
            {

                Usuario.Add(new Models.Usuario()
                {
                    Email = usr.Email,
                    UserName = usr.UserName,
                    Pass = Utilities.Utilities.Encriptar(usr.Pass)
                });
            }
            return Redirect("/");
        }

    }
}