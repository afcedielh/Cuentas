using Cuentas.Models;
using Cuentas.Models.ViewModels;
using System;
using System.Collections.Generic;
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
            var documentos = (from doc in BD.TipoDocumento
                              select new
                              {
                                  doc.Id,
                                  nombre = doc.Nombre
                              }).ToList();
            documentos.Insert(0, new
            {
                Id = 0,
                nombre = "Tipo documento"
            });
            ViewBag.Documentos = documentos;
            return View();
        }

        [HttpPost]
        public ActionResult Validar(Usuario usr)
        {
            //Consultamos los usuarios del sistema
            var Usuario = BD.Usuario;
            var pass = Utilities.Utilities.Encriptar(usr.Pass);            
            var validado = Usuario.Where(a => a.Email.Equals(usr.UserName) 
                && a.Pass.Equals(pass)).FirstOrDefault();
            if (validado != null)
            {

            }
            return Redirect("/");
        }

        [HttpPost]
        public ActionResult Registrar(VMUsuario usr)
        {
            //Consultamos los usuarios del sistema
            var Usuario = BD.Usuario;
            var Personas = BD.Persona;
            //Consultamos si existe un usuario con ese correo o con ese usuario
            var Existentes = Usuario.Where(a => a.UserName.Equals(usr.UserName) || a.Email.Equals(usr.Email)).Count();
            //Validamos si Existe mas de un usuario o correo 
            if (Existentes > 0)
                ViewBag.Error = "Ya está registrado ese Correo o UserName";
            else
            {
                if (Personas.Where(a => a.TipoDocumento == usr.TipoDocumento && a.NumeroDocumento == usr.Documento).Count() == 0)
                {
                    Personas.Add(new Persona()
                    {
                        NumeroDocumento = usr.Documento,
                        TipoDocumento = usr.TipoDocumento,
                        Nombres = "",
                        Apellidos = "",
                        Telefono = ""
                    });
                    BD.SaveChanges();
                }

                Usuario.Add(new Models.Usuario()
                {
                    Email = usr.Email,
                    UserName = usr.UserName,
                    Pass = Utilities.Utilities.Encriptar(usr.Pass),
                    Persona = Personas.Where(a => a.TipoDocumento == usr.TipoDocumento && a.NumeroDocumento == usr.Documento).Select(a => a.Id).FirstOrDefault(),
                    Intentos = 0,
                    Rol = 1,
                    Estado = 1
                });
                BD.SaveChanges();
            }
            return Redirect("/");
        }

    }
}